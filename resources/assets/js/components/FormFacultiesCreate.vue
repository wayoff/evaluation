<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Forms > Faculties: <strong>{{ form.title }}</strong> </div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Faculties</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="text-center" v-if="allFacultiesLoading">
                                            <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                                        </div>
                                        <a href="#" class="list-group-item"
                                            v-for="faculty in nonRegisteredFaculties"
                                            @click="onClickNonRegisteredFaculty(faculty)"
                                        >
                                            {{ faculty.name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Registered Faculties</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="text-center" v-if="registeredFacultiesLoading">
                                            <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>
                                        </div>
                                        <a href="#" class="list-group-item"
                                            v-for="faculty in registeredFaculties"
                                            @click="onShowRegisteredFaculty(faculty)"
                                        >
                                            {{ faculty.name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="form-faculties-create--modal-register">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"> Register Faculty: <strong> {{ faculty.name }} </strong> </h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" role="form">
                            <div class="form-group">
                                <label for="">Number of codes</label>
                                <input type="number" class="form-control" min="1" placeholder="Code Amount" v-model="formRegisterFaculty.code">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="onSubmitRegisterFaculty()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="form-faculties-create--modal-registered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"> Registered Faculty: <strong> {{ faculty.name }} </strong> </h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                          <li class="list-group-item" v-for="code in evaluation.codes"
                            :class="{
                            'list-group-item-success' : code.confirmed == 1
                        }"
                          >
                            {{ code.token }}
                          </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a :href="'/codes/downloads?evaluation_id=' + evaluation.id" class="btn btn-primary" target="_blank">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                allFaculties: [],
                allFacultiesLoading: false,
                registeredFaculties: [],
                registeredFacultiesLoading: false,
                faculty: {},
                evaluation: {},
                formRegisterFaculty: {
                    code: 10,
                }
            }
        },
        mounted() {
            let vm = this;

            vm.getAllFaculties();
            vm.getAllRegisteredFaculties();
        },
        props: {
            form: {
                required: true,
                default: () => {}
            }
        },
        methods: {
            getAllFaculties() {
                let vm = this;

                vm.allFacultiesLoading = true;

                axios.get('/api/users?user_type=2')
                    .then( (result) => {
                        vm.allFaculties = result.data;
                        vm.allFacultiesLoading = false;
                    })
            },
            getAllRegisteredFaculties() {
                let vm = this;

                vm.registeredFacultiesLoading = true;

                axios.get('/api/evaluations?form_id=' + vm.form.id + '&includes=user')
                    .then( (result) => {

                        let users = [];

                        for(let evaluation of result.data) {
                            let user = evaluation.user;
                            user.evaluation_id = evaluation.id;

                            users.push(user);
                        }

                        vm.registeredFaculties = users;
                        vm.registeredFacultiesLoading = false;
                    })
            },
            onClickNonRegisteredFaculty(faculty) {
                let vm = this;

                vm.faculty = faculty;
                $('#form-faculties-create--modal-register').modal('show');
            },
            onShowRegisteredFaculty(faculty) {
                let vm = this;

                vm.faculty = faculty;
                $('#form-faculties-create--modal-registered').modal('show');

                axios.get('/api/evaluations/' + faculty.evaluation_id)
                    .then( (result) => {
                        vm.evaluation = result.data;
                    })

            },
            onSubmitRegisterFaculty() {
                let vm = this;

                let data = {
                    user_id: vm.faculty.id,
                    form_id: vm.form.id,
                    code_count: vm.formRegisterFaculty.code
                };

                axios.post('/api/evaluations', data)
                    .then( (result) => {
                        vm.getAllFaculties();
                        $('#form-faculties-create--modal-register').modal('hide');
                    })
            }
        },
        computed: {
            nonRegisteredFaculties() {
                let vm = this;

                return vm.allFaculties.filter( (faculty) => {
                    
                    for(let registered of vm.registeredFaculties) {
                        if (registered.id == faculty.id) {
                            return false;
                        }

                        continue;
                    }

                    return true;
                } );
            }
        }
    }
</script>
