<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orderdetails Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Orderdetails 
                      <i class="fas fa-car fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Supplier ID</th>
                    <th>Orderdetail ID</th>                                       
                    <th>Modify</th>
                  </tr>

                  
                  <tr v-for="orderdetail in orderdetails" :key="orderdetail.id"> 
                    <td>{{orderdetail.id}}</td>
                    <td>{{orderdetail.order_id}}</td>
                    <td>{{orderdetail.product_id}}</td>
                    <td>
                        <a href="#" @click="editModal(orderdetail)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteOrderdetail(orderdetail.id)">
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
                <h5 class="modal-title" v-show="!editMode" id="addNew">Add New orderdetail</h5>
                <h5 class="modal-title" v-show="editMode" id="addNew">Update Orderdetail's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editMode ? updateOrderdetail(): createOrderdetail()">
                <div class="modal-body">

                <div class="form-group">                
                    <input v-model="form.order_id" type="text" name="order_id"
                      placeholder="Order ID"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('order_id') }">
                    <has-error :form="form" field="order_id"></has-error>
                </div>
       
                <div class="form-group">                
                    <input v-model="form.product_id" type="text" name="product_id"
                      placeholder="Product ID"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('product_id') }">
                    <has-error :form="form" field="product_id"></has-error>
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
            orderdetails : {},
            form: new Form({ 
              order_id: '',              
              product_id: ''
                                                        
            })
          }
        },
        methods: {
          updateOrderdetail(){
            this.$Progress.start();
            //console.log('Editing data');
            this.form.put('api/orderdetail/'+this.form.id)
            .then(() =>{
              //success
              $('#addNew').modal('hide')
              Swal.fire(
                'Updated!',
                'Information has been updated.',
                'success'
              ) 
              Fire.$emit('AfterCreate')
              this.$Progress.finish();              

            })
            .catch(() =>{
              this.$Progress.fail(); 
            })
          },
          editModal(user){
            this.editMode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
          },
          newModal(){
            this.editMode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },

          deleteOrderdetail(id){
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                //send request to the serve
                if (result.value) {
                    this.form.delete('api/orderdetail/'+id).then(()=>{                  
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        ) 
                      Fire.$emit('AfterCreate')                
                    }).catch(()=> {
                      Swal("Failed","There was something wrong.", "warning");
                    });
                }
                
              })
          },
          loadOrderdetails(){       
            axios.get('api/orderdetail').then(({ data }) => (this.orderdetails = data.data));
          },

          createOrderdetail(){
            this.$Progress.start();

            this.form.post('api/orderdetail')
            .then(()=>{
                Fire.$emit('AfterCreate');

                $('#addNew').modal('hide')

                toast.fire({
                  type: 'success',
                  title: 'Orderdetail Created successfully'
                })

                this.$Progress.finish(); 

            })
            .catch(()=>{

            })


          }
        },
        created() {
            this.loadOrderdetails();
            Fire.$on('AfterCreate',() => {
              this.loadOrderdetails();
            })
            //setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>