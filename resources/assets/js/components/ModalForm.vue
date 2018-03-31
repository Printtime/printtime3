

<template>

<div id="modal-app">
<!-- 	<p>Введённое сообщение: {{ message }}</p>
	<p v-on:click="reverseMessage">{{ normalizedSize }}</p>
 -->
  <modal :show="showModal" @close="showModal = false" :ModalData1="setModalData1">
    <h3 slot="header">Запрос на просчет</h3>
<!--     <div slot="body">
    	Содержание модального окна
    </div> -->
  </modal>

	<div class="text-center">
		<button type="button" class="btn btn-success" id="show-modal" @click="showModal = true">Заказать просчет</button>
	</div>

</div>

</template>




<script>

// register modal component
/*Vue.component('modal', {
  template: '#modal-template'
});*/


/*
Vue.component('modal', require('./Modal.vue'));
Vue.component('modal', {
  template: '#modal-template',
  props: ['show'],
  methods: {
    savePost: function () {
      // Some save logic goes here...
      
      this.$emit('close');
    }
  }
});

*/

//import Basemodal from './Modal.vue';
//

/*
Vue.component('modal', {
  template: '#modal-template',

});
*/
import Modal from './Modal.vue';

    export default {
  	    //el: '#modal-app',
       name: 'modalForm',

    	// template: '#modal-template',
    	//template: '<span>{{ message }}</span>',

        data() {
            return {
    			//showModalDef: false,
    			showModal: false,
    			setModalData1: 'PARENT ModalData1 text',
            	normalizedSize: 'def',
            	//message: this.message
                // showLoader:true
            }
        },

  		 props: ['message'],

  methods: {
	    reverseMessage: function () {
	      this.normalizedSize = this.normalizedSize.split('').reverse().join('')
	    },
	},

  components: {
    //modal: { name: 'modal', template: '#modal-template' }
	Modal

  }

        /*
        methods:{
            init:function () {
                console.log("child init ...");
                this.showLoader = false;
                this.showModal = false;
            },
         
            removeHandler(id) {
                console.log('click');
         	},
     	
        },
        created() {
        	this.showLoader = this.list;
            //console.log(this.list);
        },
        */
    }
</script>
