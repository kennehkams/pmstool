<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Suppliers Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Suppliers 
                      <i class="fas fa-car fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>                    
                    <th>Modify</th>
                  </tr>
                  
                  <tr v-for="supplier in suppliers" :key="supplier.id"> 
                    <td>{{supplier.id}}</td>
                    <td>{{supplier.name}}</td>
                    <td>
                        <a href="#" @click="editModal(supplier)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteSupplier(supplier.id)">
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
                <h5 class="modal-title" v-show="!editMode" id="addNew">Add New Supplier</h5>
                <h5 class="modal-title" v-show="editMode" id="addNew">Update Supplier's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editMode ? updateSupplier(): createSupplier()">
                <div class="modal-body">

                <div class="form-group">                
                    <input v-model="form.name" type="text" name="name"
                      placeholder="Name"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
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
            suppliers : {},
            form: new Form({              
              name: '',                              
            })
          }
        },
        methods: {
          updateSupplier(){
            this.$Progress.start();
            //console.log('Editing data');
            this.form.put('api/supplier/'+this.form.id)
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

          deleteSupplier(id){
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
                    this.form.delete('api/supplier/'+id).then(()=>{                  
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
          loadSuppliers(){       
            axios.get('api/supplier').then(({ data }) => (this.suppliers = data.data));
          },

          createSupplier(){
            this.$Progress.start();

            this.form.post('api/supplier')
            .then(()=>{
                Fire.$emit('AfterCreate');

                $('#addNew').modal('hide')

                toast.fire({
                  type: 'success',
                  title: 'Supplier Created successfully'
                })

                this.$Progress.finish(); 

            })
            .catch(()=>{

            })


          }
        },
        created() {
            this.loadSuppliers();
            Fire.$on('AfterCreate',() => {
              this.loadSuppliers();
            })
            //setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>