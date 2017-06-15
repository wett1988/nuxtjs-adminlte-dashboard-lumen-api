<template>
  
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Marka</b>CRM</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Авторизируйтесь, чтобы начать работу</p>

<!--    <form>-->
      <div class="form-group has-feedback">
        <input v-model="form.email" type="email" class="form-control" placeholder="Почта">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input v-model="form.password" type="password" class="form-control" placeholder="Пароль">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
<!--
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" @click="signin">Войти</button>
        </div>
        <!-- /.col -->
      </div>
<!--    </form>-->

<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
-->
    <!-- /.social-auth-links -->

<!--    <a href="#">I forgot my password</a><br>-->
<!--    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
</div>
  
</template>
<script>
  
import axios from '~plugins/axios'
  
let localForage = require("localforage")

import auth_init from '~plugins/auth_init'
  
export default {
  layout: 'clear', 
  data(){
    return {
      form: {
        email: '',
        password: ''
      },
      errors: {
        raw: [],
        list: []
      },
    }
  },
  mounted(){ 
    
    if( !_.isUndefined( Cookies.getJSON('user') ) ){
      this.$router.push('/')
    } 
    
//    auth_init(this.$store, this.$router)
    
  },
  methods: {
    signin(){
       
      axios.post('/auth/signin', this.form)
      .then(function (res) { 
        
//        console.log('res.data')
//        console.log(res.data)
        
        let vm = this
        
//            vm.$store.commit('user/set', res.data )
        
          Cookies.set('user', res.data, { expires: res.data.exp_days });
//          
            vm.$router.push('/user')
    

      }.bind(this))
      .catch( this.on_error )  
        
    },
    on_error(error){
        
      if (_.isObject(error)){
        
        if (_.isObject(error.response)){
        
//        if (typeof error.response.data === 'object') {  

          this.errors.raw = error.response.data

          this.errors.list = _.flatten(_.toArray(error.response.data));
        } else {
          this.errors.list = ['Неизвестная ошибка. Попробуйте еще раз.'];
        } 
        
      } else {
        console.log(error)
      }
             
 
    }
  }
}
</script>