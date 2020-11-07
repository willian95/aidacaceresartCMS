@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-products">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Crear producto
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                                
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Titulo</label>
                                <input type="text" class="form-control" v-model="name">
                                <small v-if="errors.hasOwnProperty('name')">@{{ errors['name'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Titulo en inglés</label>
                                <input type="text" class="form-control" v-model="nameEnglish">
                                <small v-if="errors.hasOwnProperty('nameEnglish')">@{{ errors['nameEnglish'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Categoría</label>
                                <div style="display:flex">
                                    <select id="category" class="form-control" v-model="category">
                                        <option :value="category.id" v-for="category in categories">@{{ category.name }}</option>
                                    </select>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#categoryModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <small v-if="errors.hasOwnProperty('category')">@{{ errors['category'][0] }}</small>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange" accept="image/*">

                                <img id="blah" :src="imagePreview" class="full-image" style="margin-top: 10px; width: 40%">
                                <small v-if="errors.hasOwnProperty('image')">@{{ errors['image'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea v-model="description" id="description" class="form-control" rows="3"></textarea>
                                <small v-if="errors.hasOwnProperty('description')">@{{ errors['description'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descripción en inglés</label>
                                <textarea v-model="descriptionEnglish" id="description" class="form-control" rows="3"></textarea>
                                <small v-if="errors.hasOwnProperty('descriptionEnglish')">@{{ errors['descriptionEnglish'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="showOnCarousel">
                                <label class="form-check-label" for="exampleCheck1">Mostrar en Banner</label>
                            </div>
                        </div>

                        


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center">Presentaciones <button class="btn btn-success" data-toggle="modal" data-target="#presentationModal">+</button></h3>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">

                            <table class="table table-bordered table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{--<th>Formato</th>--}}
                                        <th>Tamaño</th>
                                        <th>Precio</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(productFormatSize, index) in productFormatSizes">
                                        <td>@{{ index + 1 }}</td>
                                        {{--<td>@{{ productFormatSize.format.name }}</td>--}}
                                        <td>@{{ productFormatSize.size.width }}cm X @{{ productFormatSize.size.height }}cm</td>
                                        <td>$ @{{ number_format(productFormatSize.price, 2, ",", ".") }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteProductFormatSize(index)"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="store()">Crear</button>
                            </p>
                        </div>
                    </div>


                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <!-- Modal-->
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="type">Categoría</label>
                            <input type="text" class="form-control" v-model="newCategory">
                            <small v-if="categoryErrors.hasOwnProperty('category')">@{{ categoryErrors['name'][0] }}</small>
                        </div>

                        <div class="form-group">
                            <label for="type">Imagen</label>
                            <input type="file" class="form-control" ref="file" @change="onImageCategoryChange" accept="image/*">
                            <small v-if="categoryErrors.hasOwnProperty('image')">@{{ categoryErrors['image'][0] }}</small>

                            <img id="blah" :src="newCategoryPreviewPicture" class="full-image" style="margin-top: 10px; width: 40%">
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="storeCategory()">Añadir</button>
                    </div>
                </div>
            </div>
        </div> 


        <!-- Modal-->
        <div class="modal fade" id="presentationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Presentación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            {{--<div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Formato</label>
                                    <div style="display:flex;">
                                        <select id="type" class="form-control" v-model="format">
                                            <option :value="format" v-for="format in formats">@{{ format.name }}</option>
                                        </select>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#formatModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size">Tamaño</label>
                                    <div style="display:flex;">
                                        <select id="type" class="form-control" v-model="size">
                                            <option :value="size" v-for="size in sizes">@{{ size.width }}cm X @{{ size.height }}cm</option>
                                        </select>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#sizeModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="price" @keypress="isNumberDot($event)">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="addProductFormatSizes()">Añadir</button>
                    </div>
                </div>
            </div>
        </div>  

        <!-- Modal-->
        <div class="modal fade" id="formatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar formato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="type">formato</label>
                            <input type="text" class="form-control" v-model="newFormat">
                            <small v-if="formatErrors.hasOwnProperty('name')">@{{ formatErrors['name'][0] }}</small>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="storeFormat()">Añadir</button>
                    </div>
                </div>
            </div>
        </div> 

        <!-- Modal-->
        <div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar tamaño</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Ancho (cm)</label>
                                        <input type="text" class="form-control" v-model="newSizeWidth" @keypress="isNumberDot($event)">
                                        <small v-if="sizeErrors.hasOwnProperty('width')">@{{ sizeErrors['width'][0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Alto (cm)</label>
                                        <input type="text" class="form-control" v-model="newSizeHeight" @keypress="isNumberDot($event)">
                                        <small v-if="sizeErrors.hasOwnProperty('width')">@{{ sizeErrors['height'][0] }}</small>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="storeSizes()">Añadir</button>
                    </div>
                </div>
            </div>
        </div> 

    </div>

@endsection

@push("scripts")

    <script>
        
        const app = new Vue({
            el: '#dev-products',
            data(){
                return{
                    categories:[],
                    formats:[],
                    sizes:[],
                    productFormatSizes:[],
                    price:"",
                    format:"",
                    size:"",
                    picture:"",
                    imagePreview:"",
                    category:"",
                    name:"",
                    nameEnglish:"",
                    description:"",
                    descriptionEnglish:"",
                    action:"create",
                    pages:0,
                    page:1,
                    newCategory:"",
                    newCategoryPicture:"",
                    newCategoryPreviewPicture:"",
                    newFormat:"",
                    newSizeWidth:"",
                    newSizeHeight:"",
                    categoryErrors:[],
                    formatErrors:[],
                    sizeErrors:[],
                    errors:[],
                    showOnCarousel:false,
                    loading:false
                }
            },
            methods:{
                
                store(){

                    if(this.productFormatSizes.length > 0){
                        this.loading = true
                        axios.post("{{ url('/products/store') }}", {name:this.name, category: this.category, image: this.picture, productFormatSizes: this.productFormatSizes, description: this.description, showOnCarousel: this.showOnCarousel, nameEnglish: this.nameEnglish, descriptionEnglish: this.descriptionEnglish}).then(res => {
                            this.loading = false
                            if(res.data.success == true){

                                swal({
                                    title: "Excelente!",
                                    text: "Producto creado!",
                                    icon: "success"
                                }).then(function() {
                                    window.location.href = "{{ url('/home') }}";
                                });
                                

                            }else{
                               
                                alert(res.data.msg)
                            }

                            }).catch(err => {
                                this.loading = false
                                this.errors = err.response.data.errors
                            })
                    
                    }else{

                        swal({
                            title: "Oops!",
                            text: "Debe añadir presentaciones para continuar!",
                            icon: "warning"
                        })

                    }

                },
                onImageChange(e){
                    this.picture = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.picture);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.view_image = false
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.picture = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                onImageCategoryChange(e){
                    this.newCategoryPicture = e.target.files[0];

                    this.newCategoryPreviewPicture = URL.createObjectURL(this.newCategoryPicture);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.createCategoryImage(files[0]);
                },
                createCategoryImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.newCategoryPicture = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                storeCategory(){

                    this.loading = true
                    axios.post("{{ url('category/store') }}", {name: this.newCategory, image: this.newCategoryPicture})
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Perfecto!",
                                text: "Haz creado una categoría!",
                                icon: "success"
                            });
                            this.newCategory = ""
                            this.newCategoryPicture = ""
                            this.newCategoryPreviewPicture=""
                            this.fetchCategories()
                        }else{

                            swal({
                                title: "Lo sentimos!",
                                text: res.data.msg,
                                icon: "error"
                            });

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        this.categoryErrors = err.response.data.errors
                    })

                },
                fetchCategories(){

                    axios.get("{{ url('/category/all') }}").then(res => {
    
                        this.categories = res.data.categories

                    })

                },
                storeFormat(){

                    this.loading = true
                    axios.post("{{ url('format/store') }}", {name: this.newFormat})
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Perfecto!",
                                text: "Haz creado un formato!",
                                icon: "success"
                            });
                            this.newFormat = ""
                            this.fetchFormats()
                        }else{

                            swal({
                                title: "Lo sentimos!",
                                text: res.data.msg,
                                icon: "error"
                            });
                        }

                    })
                    .catch(err => {
                        this.loading = false
                        this.formatErrors = err.response.data.errors
                    })
                    

                },
                fetchFormats(){
                    axios.get("{{ url('/format/all') }}").then(res => {
    
                        this.formats = res.data.formats
                        this.format = this.formats[0]

                    })
                },
                storeSizes(){
                    this.loading = true
                    axios.post("{{ url('size/store') }}", {height: this.newSizeHeight, width: this.newSizeWidth})
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Genial!",
                                text: "Tamaño creado!",
                                icon: "success"
                            });
                            this.newSizeHeight = ""
                            this.newSizeWidth = ""
                            this.fetchSizes()
                        }else{

                            swal({
                                title: "Lo sentimos!",
                                text: res.data.msg,
                                icon: "error"
                            });

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        this.sizeErrors = err.response.data.errors
                    })
                },
                fetchSizes(){
                    axios.get("{{ url('/size/all') }}").then(res => {
    
                        this.sizes = res.data.sizes

                    })
                },
                addProductFormatSizes(){

                    if(this.size != null && this.format != null && this.price != null){
                        this.productFormatSizes.push({size: this.size, format: this.format, price: this.price})

                        this.size = ""
                        //this.format = ""
                        this.price = ""
                    }else{
                        swal({
                            title: "Oppss!",
                            text: "Debes completar todos los campos",
                            icon: "error"
                        });
                    }
                    

                },
                deleteProductFormatSize(index){

                    this.productFormatSizes.splice(index, 1)

                },
                number_format(number, decimals, dec_point, thousands_point) {

                    if (number == null || !isFinite(number)) {
                        throw new TypeError("number is not valid");
                    }

                    if (!decimals) {
                        var len = number.toString().split('.').length;
                        decimals = len > 1 ? len : 0;
                    }

                    if (!dec_point) {
                        dec_point = '.';
                    }

                    if (!thousands_point) {
                        thousands_point = ',';
                    }

                    number = parseFloat(number).toFixed(decimals);

                    number = number.replace(".", dec_point);

                    var splitNum = number.split(dec_point);
                    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
                    number = splitNum.join(dec_point);

                    return number;
                },
                isNumberDot(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                },
                isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                }


            },
            mounted(){
                
                this.fetchCategories()
                this.fetchFormats()
                this.fetchSizes()

            }

        })
    
    </script>

@endpush