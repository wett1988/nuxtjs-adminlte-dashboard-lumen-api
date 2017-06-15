<template>

<div>
    
    <div class="input-group">
      <input v-model="form.title" type="text" class="form-control" placeholder="Введите название роли"  >
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button" @click="store">Добавить</button>
      </span>
    </div>

<br>

</div>
</template>
<script>
  
import axios from '~plugins/axios'
  
export default {
  data(){
    return {
      form: {
        title: ''
      },
      errors: {
        raw: [],
        list: []
      },
    }
  },
  methods: {
    get_form(){
      this.form.title = ''
    },
    store(){
  
      axios.post('/roles', this.form)
      .then(function (res) { 
        
        /// TODO временное решенин
        
        console.log(this.$store.state.roles.list)
          
        let tmp = this.$store.state.roles.list.push(res.data)
        
        //////////////////////
        
//        tmp.push( res.data ) 
//        this.$store.commit('projects/set', tmp )
        
        this.get_form()
          
//        this.$router.push('/projects')

      }.bind(this))
      .catch( this.on_error )  
 
      
    },
    on_error(error){
      
      console.log('error')
      console.log(error)
             
      if (typeof error.response.data === 'object') {  
                              
        this.errors.raw = error.response.data
                              
        this.errors.list = _.flatten(_.toArray(error.response.data));
      } else {
        this.errors.list = ['Неизвестная ошибка. Попробуйте еще раз.'];
      } 
    }
  }
}
</script>