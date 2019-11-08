<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Vue.js CRUD - Just Laravel</title>

<!-- Fonts -->
<link rel="stylesheet"
    href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Styles -->
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: 100;
    height: auto;
    margin: 0;
}

.full-height {
    min-height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
/*  text-align: center; */
}

.title {
    font-size: 84px;
}

.m-b-md {
    margin-bottom: 30px;
}

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
  width: 300px;
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
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}
</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div id="vue-wrapper">
            <div class="content">
                <!-- <div class="form-group row"> -->
                    <!-- <div class="col-md-8"> -->



                  <div class="form-group">
                    <label for="name">Name task:</label>
                    <input type="text" class="form-control" id="namez" name="name"
                        required v-model="newItem.name" placeholder=" Enter name task">
                  </div>
                  <div class="form-group">
                    <label for="age">Data task:</label>
                    <input type="date" class="form-control" id="age" name="age"
                        required v-model="newItem.age" placeholder=" Enter date of task">
                  </div>
                  <div class="form-group">
                    <label for="profession">Description:</label>
                    <input type="text" class="form-control" id="profession" name="profession"
                        required v-model="newItem.profession" placeholder=" Enter your description task">
                  </div>

                 <button class="btn btn-primary" @click.prevent="createItem()" id="name" name="name">
                    <span class="glyphicon glyphicon-plus"></span> ADD
                 </button>

                <p class="text-center alert alert-danger"
                    v-bind:class="{ hidden: hasError }">Please fill all fields!</p>
                    <p class="text-center alert alert-danger"
                    v-bind:class="{ hidden: hasAgeError }">Please enter a valid data task!</p>
                {{ csrf_field() }}
                <p class="text-center alert alert-success"
                    v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>
                <div class="table table-borderless" id="table">
                    <table class="table table-borderless" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name Task</th>
                                <th>Data Task</th>
                                <th>Description Task</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tr v-for="item in items">
                            <td>@{{ item.id }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.age }}</td>
                            <td>@{{ item.profession }}</td>

                            <td id="show-modal" @click="showModal=true; setVal(item.id, item.name, item.age, item.profession)"  class="btn btn-info" ><span
                            class="glyphicon glyphicon-pencil"></span></td>
                            <td @click.prevent="deleteItem(item)" class="btn btn-danger"><span
                                class="glyphicon glyphicon-trash"></span></td>
                        </tr>
                    </table>
                </div>
                <modal v-if="showModal" @close="showModal=false">
                    <h3 slot="header">Edit Item</h3>
                    <div slot="body">

                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                required  :value="this.e_id">
                        Name Task: <input type="text" class="form-control" id="e_name" name="name"
                                required  :value="this.e_name">
                        Data Task: <input type="date" class="form-control" id="e_age" name="age"
                                required  :value="this.e_age">
                        Description: <input type="text" class="form-control" id="e_profession" name="profession"
                                required  :value="this.e_profession">


                    </div>
                    <div slot="footer">
                        <button class="btn btn-default" @click="showModal = false">
                        Cancel
                      </button>

                      <button class="btn btn-info" @click="editItem()">
                        Update
                      </button>
                    </div>
                </modal>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/x-template" id="modal-template">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  default header
                </slot>
              </div>

              <div class="modal-body">
                <slot name="body">

                </slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">


                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </script>
</body>
</html>
