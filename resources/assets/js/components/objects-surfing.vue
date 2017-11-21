<template>
    <div class="panel panel-default">
        <div class="panel-heading">Объекты</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <selectize ref="organs" v-model="organs.value" :settings="organs.settings" options="organs.options">
                    </selectize>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-default" v-bind:class="{ disabled: !organs.value }" 
                        v-bind:href="'/reports/organ/' + organs.value + '/preparation_receipts'">Препараты</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !organs.value }" 
                        v-bind:href="'/reports/organ/' + organs.value + '/fact'">Факт</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'/reports/organ/' + organs.value + '/plan'">План</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !organs.value }" 
                        v-bind:href="'/reports/organ/' + organs.value + '/animals'">Сведения о животных</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'#'">Отчеты</a> 
                </div>
            </div>           
            <div class="row">
                <div class="col-md-6">
                    <selectize ref="institutions" v-model="institutions.value" :disabled="institutions.disabled" 
                               :settings="institutions.settings" options="institutions.options">
                    </selectize>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-default" v-bind:class="{ disabled: !institutions.value }" 
                        v-bind:href="'/reports/institution/' + institutions.value + '/preparation_receipts'">Препараты</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !institutions.value }" 
                        v-bind:href="'/reports/institution/' + institutions.value + '/fact'">Факт</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'/reports/institution/' + institutions.value + '/plan'">План</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !institutions.value }" 
                        v-bind:href="'/reports/institution/' + institutions.value + '/animals'">Сведения о животных</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'#'">Отчеты</a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <selectize ref="subdivisions" v-model="subdivisions.value" :disabled="subdivisions.disabled" 
                               :settings="subdivisions.settings" options="subdivisions.options">
                    </selectize>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-default" v-bind:class="{ disabled: !subdivisions.value }" 
                        v-bind:href="'/subdivision/' + subdivisions.value + '/preparation_receipt'">Препараты</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !subdivisions.value }" 
                        v-bind:href="'/reports/subdivision/' + subdivisions.value + '/fact'">Факт</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'/reports/subdivision/' + subdivisions.value + '/plan'">План</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: !subdivisions.value }" 
                        v-bind:href="'/reports/subdivision/' + subdivisions.value + '/animals'">Сведения о животных</a> 
                    <a class="btn btn-default" v-bind:class="{ disabled: true }" 
                        v-bind:href="'#'">Отчеты</a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a v-bind:href="'/object/create' + (subdivisions.value ? '?subdivision=' + subdivisions.value : '')" class="btn btn-info">
                      Добавить объект
                    </a>
                </div>
            </div>
            <datatable ref="objects_table" v-bind="$data" />
        </div>
        
    </div>
</template>

<script>
    import Selectize from 'vue2-selectize'

    export default {
        components: {
            Selectize, Opt:require('./td-Opt'), NameFilter:require('./th-NameFilter')
        },
        mounted() {
            this.institutions_selectize = this.$refs.institutions.$el.selectize;
            this.subdivisions_selectize = this.$refs.subdivisions.$el.selectize;
            this.organs_selectize = this.$refs.organs.$el.selectize;
        },
        created () {
            this.xprops.eventbus.$on('OBJECT_NAME_FILTER', object_name => {
                this.object_name = object_name;
            })
        },
        watch: {
            object_name: function(newValue) {
                this.handleQueryChange();
            },
            'organs.value': function(newValue) {
                this.$cookie.set('obj_surf_organ_id', newValue, 1);
                this.institutions_selectize.disable();
    			this.institutions_selectize.clearOptions();
    			if (newValue==="") return;
    			this.institutions_selectize.load( (callback) => {
    			    axios.get('/api/organs/' + newValue + '/institutions').then(resp => {
    			        this.institutions_selectize.enable();
                        callback(resp.data);
                        this.institutions_selectize.setValue(this.$cookie.get('obj_surf_institution_id'));
                    });
    			});
            },
            'institutions.value': function(newValue) {
                this.$cookie.set('obj_surf_institution_id', newValue, 1)
                this.subdivisions_selectize.disable();
    			this.subdivisions_selectize.clearOptions();
    			if (newValue==="") return;
    			this.subdivisions_selectize.load( (callback) => {
    			    axios.get('/api/institutions/' + newValue + '/subdivisions').then(resp => {
    			        this.subdivisions_selectize.enable();
                        callback(resp.data);
                        this.subdivisions_selectize.setValue(this.$cookie.get('obj_surf_subdivision_id'));
                    });
    			});
            },
            'subdivisions.value': function(newValue) {
                this.$cookie.set('obj_surf_subdivision_id', newValue, 1)
                this.handleQueryChange();
            },
            query: {
              handler () {
                this.handleQueryChange();
              },
              deep: true
            }
        },
        methods: {
            handleQueryChange () {
                if(this.subdivisions.value) {
                    let subdivision_id = this.subdivisions.value;
                    var number = this.query.offset/this.query.limit+1;
                    var size = this.query.limit;
                    var sortQuery = this.query.sort?'&sort='+this.query.sort+'&order='+this.query.order:"";
                    axios.get(`/api/subdivisions/${subdivision_id}/objects?page[number]=${number}&page[size]=${size}${sortQuery}&object_name=${encodeURIComponent(this.object_name)}`)
                        .then(resp => {
                            this.data = resp.data.data;
                            this.total = resp.data.total;
                        })
                        .catch(err =>{
                            alert(err.exception);
                        });
                }
            }
        },
        data() {
            return {
                object_name: "",
                supportBackup: true,
                columns: [
                    { title: 'Объект', field: 'name', thComp: 'NameFilter', sortable: true, group:'Столбцы' },
                    { title: 'Адрес', field: 'address', group:'Столбцы', visible: false },
                    { title: 'Телефон', field: 'phone', group:'Столбцы', visible: false },
                    { title: 'Действия', tdComp: 'Opt', group: 'Столбцы', visible: true }
                ],
                data: [],
                total: 0,
                query: {},
                // https://github.com/selectize/selectize.js/blob/master/docs/usage.md 
                organs: {
                    settings: {
                        valueField: 'id',
                		labelField: 'name',
                		searchField: ['name'],
                		create: false,
                		selectOnTab: true,
                		preload: true,
                        load: (query, callback) => {
                            this.organs_selectize.settings.load = null;
                            axios.get('/api/organs').then(resp => {
                                callback(resp.data);
                                this.organs_selectize.setValue(this.$cookie.get('obj_surf_organ_id'));
                            });
                        }
                    }
                },
                institutions: {
                    disabled: true,
                    settings: {
                        valueField: 'id',
                		labelField: 'name',
                		searchField: ['name'],
                		create: false,
                		selectOnTab: true
                    }
                },
                subdivisions: {
                    disabled: true,
                    settings: {
                        valueField: 'id',
                		labelField: 'name',
                		searchField: ['name'],
                		create: false,
                		selectOnTab: true
                    }
                },
                xprops: {
                    eventbus: new Vue()
                }
            }
        }
    }
</script>
