@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" >
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">NewsLetter
                    </div>
                    <div class="card-toolbar">
  
     
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">

                    <div class="form-group">
                        <label for="natitleme">Titulo</label>
                        <input type="text" class="form-control" id="title">
                        
                    </div>

                    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                    
                    <div id="dev-newsletter">
                        <div class="loader-cover-custom" v-if="loading == true">
                            <div class="loader-custom"></div>
                        </div>
                        <div class="loader-cover-custom" v-if="loading == true">
                            <div class="loader-custom"></div>
                        </div>
                        <p class="text-center">
                            <button class="btn btn-primary" @click="create()">Crear</button>
                        </p>
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

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
    <script>
        
        const app = new Vue({
            el: '#dev-newsletter',
            data(){
                return{
                    title:"",
                    text:"",
                    loading:false,
                }
            },
            methods:{
                create(){

                    this.text = CKEDITOR.instances.editor1.getData()
                    this.title = $("#title").val()
                    this.loading = true
                    axios.post("{{ url('/newsletter/store') }}", {text: this.text, title: this.title}).then(res => {

                        this.loading = false
                        if(res.data.success == true){
                            swal({
                                title: "Genial!",
                                text: res.data.msg,
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

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value){
                            alert(value)
                        });
                    })

                }
            }

        })
    
    </script>

@endpush