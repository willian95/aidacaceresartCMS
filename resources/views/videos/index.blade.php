@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-home-video">

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
                        <h3 class="card-label">Video Home
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Video</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange" accept="video/*">

                                <video loop style="width: 100%;" autoplay="true" muted="muted">
                                    <source src="{{ $homeVideo->video }}" type="video/mp4">
                                </video>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="active">Activo</label>
                                <select class="form-control" id="active" v-model="active">
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="update()">Actualizar</button>
                            </p>
                        </div>
                    </div>

                </div>

                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->


    </div>

@endsection

@push("scripts")

    
    <script>
        
        const app = new Vue({
            el: '#dev-home-video',
            data(){
                return{
                    image:"",
                    imagePreview:"{{ $homeVideo->video }}",
                    active:"{{ $homeVideo->active }}",
                    loading:false,
                }
            },
            methods:{
                update(){

                    this.loading = true
                    axios.post("{{ url('/home-video/update') }}", {video: this.image, active: this.active}).then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Excelente",
                                text:res.data.msg,
                                icon:"success"
                            }).then(res => {

                                window.location.reload()

                            })

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                    })

                },
                onImageChange(e){
                    this.image = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.image);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
           
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

        })
    
    </script>

@endpush