<template>
 
<!--
 <div class="input-group-sm">
 
    <input type="text" class="form-control">
   <span class="input-group-addon">
         <button type="submit" class="btn btn-primary btn-sm editable-submit"><i class="fa fa-check" aria-hidden="true"></i></button><button type="button" class="btn btn-default btn-sm editable-cancel"><i class="fa fa-times" aria-hidden="true"></i></button>
   </span> 
    <div class="editable-buttons">
 </div>
   
 </div>
-->
    
    <div class="form-group" :class="{ 'has-error': state.error}">

    <div class="input-group">
      <input type="text" class="form-control" :disabled="!state.edit" v-model="val">
        
      <div class="input-group-btn" v-if="state.edit"> 
        <button type="button" class="btn btn-default" @click="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-default" @click="rollback"><i class="fa fa-times" aria-hidden="true"></i></button> 
      </div>
      
      <div class="input-group-btn" v-if="!state.edit">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true" style="margin-right: 10px;"></i> <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right"> 
          <li><a href="#" @click="destroy">Удалить</a></li>
          <li><a href="#" @click="edit">Изменить</a></li>
 
        </ul>
      </div><!-- /btn-group -->
       
    </div><!-- /input-group -->
    
    <span class="help-block" v-if="state.error">{{ msg }}</span>
    
  </div>
 
  
  
</template>
<script>
  
import _ from 'lodash'
  
export default {
  props: ['value', 'required', 'error_msg'],
  data(){
    return {
      state: {
        edit: false,
        error: false
      },
      val: '',
      msg: "Value is required"
    }
  }, 
  mounted(){
     this.get_data()
  },
  methods: {
    validate(){
      
        this.state.error = false
        
        if ( _.eq(this.val.length, 0 ) ){
          this.state.error = true
          
          return false
        }
      
      return true
      
    },
    destroy(){
      this.$emit('destroy')
    },
    get_data(){
      if (this.value) { this.val = this.value }
      if (this.error_msg) { this.msg = this.error_msg }
    },
    edit(){
      this.state.edit = !this.state.edit
    }, 
    submit(){
       
      if(this.required){
        
        if( this.validate() ){
          
          this.$emit('input', this.val)
          this.$emit('update')
          
          this.edit()
  
        }
 
      }
      
       
      
 
    },
    rollback(){
      
      this.get_data()
      
      this.edit()
      
    }
  }
}
</script>