<style>
    #prices {
        margin-top:20px;
    }
</style>

<template>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
            <select class="form-control" v-model="selected">
              <option value="0" disabled selected>--- Выберете тип ---</option>
              <option v-for="option1 in options1" v-bind:value="option1.id">
                {{ option1.title }}
              </option>
            </select>
            </div>

            <div class="col-md-6">
            <select class="form-control" v-if="selected2_seen" v-model="selected2">
              <option value="0" disabled selected2>--- Выберете материал ---</option>
              <option v-for="option2 in options2" :value="option2.id">
                {{ option2.title }}
              </option>
            </select>
            </div>

            <div v-if="prices_seen" class="col-md-12">
            <table id="prices" class="table table-hover">
              <thead>
                <tr>
                  <th class="hidden-xs">{{ showTitleSelected2 }}</th>
                  <th>Качество</th>
                  <th class="hidden-xs">Площадь</th>
                  <th>Цена</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="price in prices">
                <td class="hidden-xs">{{ price.label }}</td>
                <td>{{ price.title }}</td>
                <td class="hidden-xs">{{ selected2_height/1000*selected2_width/1000 }} м<sup>2</sup></td>
                <td>{{ price.pivot.price }} грн.</td>
              </tr>
              </tbody>
            </table>

            
            
            </div>


        </div>



    </div>
</template>

<script>

//<modal-form :message="parentMsg"></modal-form>

//import ModalForm from './ModalForm.vue';

    export default {
       data() {
        return {
            selected: 0,
            selected2: 0,
            selected2_seen: false,
            selected2_loading: null,
            showTitleSelected2: null,
            selected2_roll_width: null,
            selected2_height: null,
            selected2_width: null,
            prices: [],
            prices_seen: false,

            options1: [],
            options2: [],

            //parentMsg: 'message text',

        }
      },
        created() {
            this.getProducts();
        },
        watch: {
            selected: function () {
              this.getTypes();
            },
            selected2: function (value) {
              if(value > 0) {
                  this.getPrices();
                  
                let temp = this.options2;
                for (var i = 0; i < temp.length; i++) {
                  if (temp[i].id === value) {
                    this.showTitleSelected2 = temp[i].title;
                    // this.message = this.showTitleSelected2;
                    this.selected2_roll_width = temp[i].roll_width;
                    this.selected2_height = temp[i].height;
                    this.selected2_width = temp[i].width;
                  }
                }

              }
            }
          },
        methods: {
            getProducts: function () {
                axios.get('/api/price?type=products&id=9')
                .then((response) => {
                  this.options1 = response.data;
                }).catch((error) => console.log(error.response.data));
            },
            getTypes: function () {
                  this.selected2_loading = 'loading...';
                  this.selected2_seen = true;
                axios.get('/api/price?type=types&id='+this.selected)
                .then((response) => {
                  this.options2 = response.data;
                  this.selected2 = 0;
                }).catch((error) => console.log(error.response.data));
                  this.selected2_loading = '';
            },
            getPrices: function () {
                  this.prices_seen = true;

                axios.get('/api/price?type=vars&id='+this.selected2)
                .then((response) => {
                  //console.log(response.data);
                  this.prices = response.data;
                }).catch((error) => console.log(error.response.data));
            }
        },
        components: {
             //'modal-form': ModalForm,
          }
    }
</script>
