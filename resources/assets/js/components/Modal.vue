<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  min-width: 300px;
  max-width: 50vw;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #f1672a;
}

.modal-body {
  margin: 20px 0px 0px 0px;
  
    /*position: relative;*/
    /*padding: 15px 0px;*/
}

.modal-default-button {
  /*float: right;*/

  background: #f1672a;
  color: #fff;
  text-align: center;
  display: block;
  margin: 0 auto;
  border-radius: 0px;

/*    background: #f1672a;
    color: #fff;
    text-align: center;
    display: block;
    margin: 0 auto;
    position: relative;
    width: 60%;
    padding: 2px 5px;*/

}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.modal-container .glyphicon-remove {
    float: right;
    right: -10px;
    cursor: pointer;
    color: #ccc;
}
.modal-container .glyphicon-remove:hover {
    color: #666;
}

</style>


<template>

  <transition name="modal">
    <div class="modal-mask" @click="close" v-show="show">
      <div class="modal-wrapper">
        <div class="modal-container" @click.stop>
          <form id="form" v-on:submit.prevent="send">
            <div class="glyphicon glyphicon-remove" @click="close"></div>

<h4 class="text-center" v-if="response">{{ response }}</h4>
  <div v-else>

            <div class="modal-header">
              <slot name="header"></slot>
            </div>

            <div class="modal-body">
              <slot name="body">
                  <div v-bind:class="[groupClass, validation.name ? validClass : '']">
                    <input class="form-control" id="inputSuccess1" aria-describedby="helpBlock1" type="text" v-model="newUser.name" placeholder="Ваше имя" required="required">
                    <!-- <span id="helpBlock1" class="help-block">A block 1 of help text that breaks onto.</span> -->
                  </div>
                  <div v-bind:class="[groupClass, validation.phone ? validClass : '']">
                    <input class="form-control" id="inputSuccess3" aria-describedby="helpBlock3" type="text" v-model="newUser.phone" placeholder="Контактный номер телефона" required="required">
                    <!-- <span id="helpBlock3" class="help-block">A block 1 of help text that breaks onto.</span> -->
                  </div>
                  <div v-bind:class="[groupClass, validation.email ? validClass : '']">
                    <input class="form-control" id="inputSuccess2" aria-describedby="helpBlock2" type="email" v-model="newUser.email" placeholder="ваш-email@адрес.com" for="inputSuccess2">
                    <!-- <span id="helpBlock2" class="help-block">A block 2 of help text that breaks onto a new line and may extend beyond one line.</span> -->
                  </div>
              </slot>
            </div>

            <div class="modal-footer">
              <slot name="footer">
                <button class="btn modal-default-button" @click="send()">{{ submit }}</button>
              </slot>
            </div>
</div>

          </form>
        </div>
      </div>
    </div>
  </transition>

</template>


<script>

var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    export default {
      // name: 'modal',
        data() {
            return {
              newUser: {
                name: '',
                email: '',
                phone: ''
              },

              validClass: 'has-success',
              groupClass: 'form-group',

              response: '',
              //setModalData1: this.ModalData1,
    			     // showModal: this.showModalDef,
            }
        },

       //props: ['ModalData1', 'show'],
       props: ['show', 'submit'],


      methods: {
        close: function () {
          this.$emit('close');
        },
        send: function () {

          if(this.isValid) {

            this.newUser = {
                name: '',
                email: '',
                phone: ''
              };
            
            this.response = 'Спасибо, мы скоро с вами свяжемся';
    
            setTimeout(() => {
               this.close();
                setTimeout(() => { this.response = ''; }, 800);
            }, 2000);
            //this.close();
          }

        }
      },

  computed: {
    validation: function () {
      return {
        name: !!this.newUser.name.trim(),
        //email: emailRE.test(this.newUser.email),
        phone: !!this.newUser.phone.trim(),
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  },

      mounted: function () {
        document.addEventListener("keydown", (e) => {
          if (this.show && e.keyCode == 27) {
            this.close();
          }
        });
      }

	   }

</script>
