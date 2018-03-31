<template>
<div id="modal-app">
  <modal :show="showModal" @close="showModal = false" :submit="submit">
    <h3 slot="header">{{ formname }}</h3>
  </modal>
	<div class="text-center">
		<button type="button" :class="['btn', btnclass]" id="show-modal" @click="showModal = true">{{ btnname }}</button>
	</div>
</div>
</template>


<style>
  .btn { margin-bottom: 10px; } 
</style>

<script>
import Modal from './Modal.vue';

    export default {
       name: 'RequestForm',

        data() {
            return {
    			     showModal: false,
            }
        },
       props: ['btnclass', 'btnname', 'formname', 'submit'],

      components: { Modal }
    }
</script>
