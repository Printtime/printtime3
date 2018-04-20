<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageType;
use Illuminate\Http\Request;
use Storage;

class PageController extends Controller {
/*
public function index()
{
$pages = Page::published()->paginate();
return dd($pages);
}
 */

	public function sitemap() {
		$pages = Page::where('published', true)->get();
		$content = view('page.sitemap', compact('pages'));
		return response($content, 200)->header('Content-Type', 'text/xml');
	}

	public function content2arr(Page $page) {
		$content = $page->content;
		$split = '***';
		$content = str_replace("<p>" . $split, $split, $content);
		$content = str_replace($split . "</p>", $split, $content);
		$content = explode($split, $content);

		foreach ($content as $key => $value) {
			$content[$key] = [];
			$content[$key]['type'] = 'html';
			$data = trim($value);

			$split2 = substr($data, 0, 4);

/*
$split2vue = substr($data, 0, 3);

if($split2 == 'type') {
parse_str(html_entity_decode($data), $output);
$content[$key] = $output;

if($content[$key]['type'] == 'tag') {
//произвольный DOM element
//$content[$key]['relations'] = $content[$key];
} else {
//relations связь
$content[$key]['relations'] = $page->relations->where('type.system', $output['type']);
}
//$content[$key]['relations'] = $page->relationsWhere($output['type'])->get();
} else {
$content[$key]['data'] = $data;
}
 */

			if ($split2 == 'type') {
				parse_str(html_entity_decode($data), $output);
				$content[$key] = $output;

				switch ($content[$key]['type']) {
				case 'tag':
					break;
				case 'menu':
					$menu = \App\Menu::where('page_id', $page->id)->first();
					$resmenu = \App\Menu::with('page')->orderBy('_lft', 'desc')->whereIsAfter($menu->id)->get()->toTree();
					$content[$key]['relations'] = $resmenu;
					break;
				default:
					$content[$key]['relations'] = $page->relations->where('type.system', $output['type']);
				}

			} else {
				$content[$key]['data'] = $data;
			}

#unset($content[$key]);

			if ($content[$key]['type'] == 'html' && empty($content[$key]['data'])) {unset($content[$key]);}
		}
		#dd($content);
		return $page->content = $content;
	}

	public function home() {
		$page = Page::with('relations.type', 'relations.avatar', 'relations.avatar.imagetypes')->findOrFail('1');
		#return $page->relations->groupby('page_types_id');
		/*
	    $relations = $page->relations;
	    print_r($relations);
	    return '123';
	    */

		$content = $this->content2arr($page);

/*
$types = $page->relations->groupby('page_types_id');
foreach ($types as $t) {
echo $t;
}

return $page->name;

if(empty($page->template)) { $page->template = 'home'; }
$content = $this->content2arr($page);
 */
		if (empty($page->template)) {$page->template = 'home';}
		return view('page.' . $page->template, ['page' => $page, 'content' => $content]);
	}

	public function show(Request $request) {
		#echo $request->page;
		#echo $request->number;
		#return dd($request);
		#return dd($request->page);
		#$page = (is_numeric($request->page) ? Page::findOrFail($request->page) : Page::published()->whereSlug($request->page)->firstOrFail());
		$page = Page::published()->whereSlug($request->slug)->firstOrFail();

		// $menu = \App\Menu::where('page_id', $page->id)->first();
		// $resmenu =\App\Menu::with('page')->orderBy('_lft', 'desc')->whereIsAfter($menu->id)->get()->toTree();
		/*	    foreach($resmenu as $item) {
	    	echo $item->name;
	    	echo $item->page->slug;
	    }*/

		if (empty($page->template)) {$page->template = 'main';}
		$content = $this->content2arr($page);

		$relations = $page->relations()->paginate(12);
		#$relations = $page->relations()->paginate(2, ['*'], 'page', $request->number);
		#
		# return dd($relations);
		$relations->setPath($page->slug);
		#$relations->withPath('custom/url');

		return view('page.' . $page->template, compact('page', 'content', 'relations'));

		#return view('page.'.$page->template, ['page' => $page, 'content' => $content]);
	}

	public function search(Request $request) {
		$term = $request->input('term');
		$term = htmlentities($term);

		$pages = Page::published()
			->where('name', 'like', '%' . $term . '%')
			->orWhere('slug', 'like', '%' . $term . '%')
			->select(['id', 'name', 'slug'])->get();

		$res = [];
		if ($pages) {
			foreach ($pages as $page) {
				$res[] = [
					'id' => $page->id,
					'name' => $page->name,
					'label' => $page->name,
					'slug' => $page->slug,
				];
			}
		}
		return $res;

	}

	public function create($page = null) {

		$changefreq_array = [
			'always' => 'Всегда',
			'hourly' => 'Почасово',
			'daily' => 'Ежедневно',
			'weekly' => 'Еженедельно',
			'monthly' => 'Ежемесячно',
			'yearly' => 'Раз в год',
			'never' => 'Никогда',
		];

		$pagetypes = collect(PageType::get());
		$pagetypes_plucked = $pagetypes->pluck('title', 'id');
		$pagetypes_plucked->all();

		// $imagetypes = ImageType::get();
		//$imagetypes = collect(ImageType::get());
		//$imagetypes_plucked = $imagetypes->pluck('title', 'id');
		//$imagetypes_plucked->all();

		if ($page == null) {
			$page = new Page();
		} else {
			$page = Page::findOrFail($page);
		}

		return view('admin.page', ['page' => $page, 'changefreq_array' => $changefreq_array, 'pagetypes' => $pagetypes_plucked]);
	}

	public function store(Request $request) {
		$page = new Page();
		$page->fill($request->all());
		if ($request->published == 'on') {$page->published = true;} else { $page->published = false;}
		if (empty($request->created_at)) {unset($page->created_at);}
		if (empty($request->updated_at)) {unset($page->updated_at);}
		$page->save();

		return redirect()->route('admin.pagetype.show', ['pagetype' => $page->type->id]);
		// return redirect()->back();
	}

	public function update(Request $request, Page $page) {
		$page->fill($request->all());

		if ($request->published == 'on') {$page->published = true;} else { $page->published = false;}
		#$page->anons = str_replace("&nbsp;", "", $page->anons);
		$page->anons = html_entity_decode($page->anons);
		$page->save();
		return redirect()->route('admin.pagetype.show', ['pagetype' => $page->type->id]);
		// return redirect()->back();
	}

	public function delete(Request $request) {
		$page = Page::findOrFail($request->page);
		foreach ($page->images as $image) {
			$return = Storage::disk('public')->delete('images/' . $image->filename);
			if ($return) {
				$image->delete();
			}
		}
		$page->relations()->detach();
		$page->relationsReverse()->detach();
		$page->delete();
		return redirect()->route('admin.pagetype.show', ['pagetype' => $page->type->id]);
	}

	// public function test(Page $page)
	// {
	// 	return dd($page);
	// }

	public function relations(Request $request, Page $page) {
		$pages = $page->relations()->paginate();
		return view('admin.pages', ['name' => $page->name, 'pages' => $pages]);
	}

	public function json(Request $request) {
		if ($request->ajax()) {
			$page = Page::find($request->page_id);

			if ($request->type == 'create') {
				$page->relationsReverse()->attach($request->to_id);
			}
			if ($request->type == 'delete') {
				$page->relationsReverse()->detach($request->to_id);
			}
			return response()->json(true);
		}
		return false;
	}

}
