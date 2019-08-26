<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Orders Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Orders 
                      <i class="fas fa-car fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Order Number</th>  
                    <th>Modify</th>                 
                  </tr>

                  
                  <tr v-for="order in orders" :key="order.id"> 
                    <td>{{order.id}}</td>
                    <td>{{order.order_number}}</td>
                    <td>
                        <a href="#" @click="editModal(order)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteOrder(order.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="!editMode" id="addNew">Add New order</h5>
                <h5 class="modal-title" v-show="editMode" id="addNew">Update order's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editMode ? updateOrder(): createOrder()">
                <div class="modal-body">

                <div class="form-group">                
                    <input v-model="form.order_number" type="text" name="order_number"
                      placeholder="Order Number"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('order_number') }">
                    <has-error :form="form" field="order_number"></has-error>
                </div>
                       

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
          return{
            editMode: false,
            orders : {},
            form: new Form({              
              order_number: '',                                             
            })
          }
        },
        methods: {
        //   updateOrder(){
        //     this.$Progress.start();
        //     //console.log('Editing data');
        //     this.form.put('api/order/'+this.form.id)
        //     .then(() =>{
        //       //success
        //       $('#addNew').modal('hide')
        //       Swal.fire(
        //         'Updated!',
        //         'Information has been updated.',
        //         'success'
        //       ) 
        //       Fire.$emit('AfterCreate')
        //       this.$Progress.finish();              

        //     })
        //     .catch(() =>{
        //       this.$Progress.fail(); 
        //     })
        //   },
        //   editModal(user){
        //     this.editMode = true;
        //     this.form.reset();
        //     $('#addNew').modal('show');
        //     this.form.fill(user);
        //   },
          newModal(){
            this.editMode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },

        //   deleteOrder(id){
        //       Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //         }).then((result) => {

        //         //send request to the serve
        //         if (result.value) {
        //             this.form.delete('api/order/'+id).then(()=>{                  
        //                 Swal.fire(
        //                   'Deleted!',
        //                   'Your file has been deleted.',
        //                   'success'
        //                 ) 
        //               Fire.$emit('AfterCreate')                
        //             }).catch(()=> {
        //               Swal("Failed","There was something wrong.", "warning");
        //             });
        //         }
                
        //       })
        //   },
          loadOrders(){       
            axios.get('api/order').then(({ data }) => (this.orders = data.data));
          },

          createOrder(){
            this.$Progress.start();

            this.form.post('api/order')
            .then(()=>{
                Fire.$emit('AfterCreate');

                $('#addNew').modal('hide')

                toast.fire({
                  type: 'success',
                  title: 'Order Created successfully'
                })

                this.$Progress.finish(); 

            })
            .catch(()=>{

            })


          }
        },
        created() {
            this.loadOrders();
            Fire.$on('AfterCreate',() => {
              this.loadOrders();
            })
            //setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>