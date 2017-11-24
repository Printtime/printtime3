
// const $ = require('jquery');


function init() {
	

    $('#menuTree').tree({
    autoOpen: true,
    dragAndDrop: true,
    // saveState: true
    });

    $('#menuTree').bind(
    'tree.move',
    function(event) {
        console.log('moved_node', event.move_info.moved_node);
        console.log('target_node', event.move_info.target_node);
        console.log('position', event.move_info.position);
        console.log('previous_parent', event.move_info.previous_parent);
    }
	);


};

export default init;

