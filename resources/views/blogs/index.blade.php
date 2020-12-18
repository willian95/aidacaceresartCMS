@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-blog">

        <div class="loader-cover-custom" v-if="loading == true">
			<div class="loader-custom"></div>
		</div>

        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Blogs
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        {{--<div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-print"></i>
                                            </span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-copy"></i>
                                            </span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-excel-o"></i>
                                            </span>
                                            <span class="navi-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-pdf-o"></i>
                                            </span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>--}}
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        <button href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#categoryModal" @click="create()">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Nuevo Blog</button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style="">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Nombre español</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Nombre en ingles</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort">
                                        <span>Imagen</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="blog in blogs">
                                    <td>@{{ blog.title }}</td>
                                    <td>@{{ blog.english_title }}</td>
                                    <td>
                                        <img :src="blog.image" alt="" style="width: 60%;">
                                    </td>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#categoryModal" @click="edit(blog)">
                                            <i class="far fa-eye"></i>
                                        </button>
                                        <button class="btn btn-secondary" @click="erase(blog.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--end: Datatable-->
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
                        <h5 class="modal-title" id="exampleModalLabel">@{{ modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titulo español</label>
                            <input type="text" class="form-control" id="title" v-model="title">
                            <small v-if="errors.hasOwnProperty('title')">@{{ errors['title'][0] }}</small>
                        </div>

                        <div class="form-group">
                            <label for="englishTitle">Titulo inglés</label>
                            <input type="text" class="form-control" id="englishTitle" v-model="englishTitle">
                            <small v-if="errors.hasOwnProperty('englishTitle')">@{{ errors['englishTitle'][0] }}</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción español</label>
                            <textarea type="text" class="form-control" id="description" v-model="description"></textarea>
                            <small v-if="errors.hasOwnProperty('description')">@{{ errors['description'][0] }}</small>
                        </div>

                        <div class="form-group">
                            <label for="englishDescription">Descripción inglés</label>
                            <textarea type="text" class="form-control" id="englishDescription" v-model="englishDescription"></textarea>
                            <small v-if="errors.hasOwnProperty('englishDescription')">@{{ errors['englishDescription'][0] }}</small>
                        </div>

                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="date" class="form-control" id="date" v-model="date">
                            <small v-if="errors.hasOwnProperty('date')">@{{ errors['date'][0] }}</small>
                        </div>
                    
                        <div class="form-group">
                            <label for="image">Imágen</label>
                            <input type="file" class="form-control" ref="file" @change="onImageChange" accept="image/*" id="image">
                            <small v-if="errors.hasOwnProperty('image')">@{{ errors['image'][0] }}</small>
                        </div>

                        <img id="blah" :src="imagePreview" class="full-image" style="margin-top: 10px; width: 40%">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary font-weight-bold"  @click="store()" v-if="action == 'create'">Crear</button>
                        <button type="button" class="btn btn-primary font-weight-bold"  @click="update()" v-if="action == 'edit'">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push("scripts")

    <script>
        
        const app = new Vue({
            el: '#dev-blog',
            data(){
                return{
                    blogs:[],
                    modalTitle:"Nuevo blog",
                    title:"",
                    blogId:"",
                    englishTitle:"",
                    description:"",
                    englishDescription:"",
                    date:"",
                    action:"create",
                    imagePreview:"",
                    picture:"",
                    errors:[],
                    loading:false
                }
            },
            methods:{
                
                create(){
                    this.action = "create"
                    this.title = ""
                    this.englishTitle = ""
                    this.description = ""
                    this.englishDescription = ""
                    this.picture = ""
                },
                store(){

                    this.loading = true
                    axios.post("{{ url('blog/store') }}", {title: this.title, englishTitle: this.englishTitle, description: this.description, englishDescription: this.englishDescription, image: this.picture, date: this.date})
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Perfecto!",
                                text: "Haz creado un blog!",
                                icon: "success"
                            });
                            
                            this.title = ""
                            this.picture = ""
                            this.description  = ""
                            this.englishDescription = ""
                            this.englishTitle = ""
                            this.imagePreview=""
                            this.fetch()
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
                        this.errors = err.response.data.errors
                    })

                },
                update(){

                    this.loading = true
                    axios.post("{{ url('blog/update') }}", {id: this.blogId, title: this.title, englishTitle: this.englishTitle, description: this.description, englishDescription: this.englishDescription, image: this.picture, date: this.date})
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Excelente!",
                                text: "Has actualizado un blog!",
                                icon: "success"
                            });

                            this.title = ""
                            this.picture = ""
                            this.description  = ""
                            this.englishDescription = ""
                            this.englishTitle = ""
                            this.date = ""
                            this.imagePreview=""
                            this.fetch()
                            
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
                        this.errors = err.response.data.errors
                    })

                },
                edit(blog){

                    this.modalTitle = "Editar blog"
                    this.action = "edit"
                    this.title = blog.title
                    this.englishTitle = blog.english_title
                    this.description = blog.description
                    this.englishDescription = blog.english_description
                    this.imagePreview = blog.image
                    this.date = blog.date
                    this.blogId = blog.id

                },
                fetch(page = 1){

                    axios.get("{{ url('blog/fetch') }}")
                    .then(res => {

                        this.blogs = res.data.blogs

                    })

                },
                erase(id){
                    
                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás este blog!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.loading = true
                            axios.post("{{ url('/blog/delete/') }}", {id: id}).then(res => {
                                this.loading = false
                                if(res.data.success == true){
                                    swal({
                                        title: "Genial!",
                                        text: "Blog eliminado!",
                                        icon: "success"
                                    });
                                    this.fetch()
                                }else{

                                    swal({
                                        title: "Lo sentimos!",
                                        text: res.data.msg,
                                        icon: "error"
                                    });

                                }

                            }).catch(err => {
                                this.loading = false
                                $.each(err.response.data.errors, function(key, value){
                                    alert(value)
                                });
                            })

                        }
                    });

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
                toggleMenu(){

                    if(this.showMenu == false){
                        $("#menu").addClass("show")
                        this.showMenu = true
                    }else{
                        $("#menu").removeClass("show")
                        this.showMenu = false
                    }

                }


            },
            mounted(){
                
                this.fetch()

            }

        })
    
    </script>

@endpush