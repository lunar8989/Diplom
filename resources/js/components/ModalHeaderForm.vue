<template>
    <div class="modal fade" id="myModalAuth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" id="headModal">
                  <input type="submit" name="authBtn" class="modalBtn" value="Авторизация" @click="formStatus = 'auth'">
                  <input type="submit" name="regBtn" class="modalBtn" value="Регистрация" @click="formStatus = 'reg'">
              </div>
              <div class="modal-body">
                  <form ref="auth" method="post" class="modalForm" id="formAuth" v-if="formStatus == 'auth'">
                  
                      <input type="text" name="email"  placeholder="Почта"><br>
                      <input type="password"  name="password" placeholder="Пароль"><br>
                      <input @click="login" type="submit" name="submit" value="Войти" class="runBtn">
                  </form>

                  <form ref="reg" method="post" class="modalForm" id="formReg" v-else-if="formStatus == 'reg'">
                      <input type="text" name="name"  placeholder="Ваше имя"><br>
                      <input type="email" name="email"  placeholder="Почта"><br>
                      <input type="password"  name="password" placeholder="Пароль"><br>
                      <input @click="register" type="submit" name="submit" value="Зарегистрироваться" class="runBtn"> 
                  </form>
              </div>
          </div>
      </div>
    </div>
</template>
<script>

export default {
    
    data(){
      return{
        formStatus: 'auth',
      }
    },
    methods: {
      register() {
        
      },

      login() {
        
      }
    }
  }


</script>
<style>

.modal-header{
  border-bottom: 6px solid #1F7B67;
}

.modal-content{
    border: 6px solid #1F7B67;
}
#zatemnenie {
  background: rgba(102, 102, 102, 0.5);
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  display: none; }
  #zatemnenie:target {
    display: block; }

#labelReg {
  text-align: center; }

.modalForm {
  width: 350px;
  height: 350px;
  text-align: center;
  padding: 15px;
  color: white;
  margin: auto; }
  .modalForm input {
    outline: none;
    margin: 6px;
    width: 300px;
    height: 50px;
    border: 2px solid black;
    border-radius: 10px;
    padding-left: 15px;
    background-color: #FF6200;
    color: white;
    font-size: 20px; }
  .modalForm input[type=submit] {
    padding: 0; }

#headModal input[type=submit] {
  border-radius: 5px;
  background-color: #333333;
  color: white;
  width: 150px;
  font-size: 22px;
  padding: 5px; }

.runBtn:hover{
    background-color: #333333;
}

.close {
  display: inline-block;
  border: 2px solid black;
  color: white;
  padding: 0 12px;
  margin: 10px;
  text-decoration: none;
  background: #131426;
  font-size: 14pt;
  cursor: pointer; }
  .close:hover {
    background: #333333; }
</style>