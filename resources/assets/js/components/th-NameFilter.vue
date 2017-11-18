<template>
  <div class="th-name-filter-comp">
      <label for="obj_name">Имя объекта:</label>
      <input v-model.lazy="object_name" type="text" class="form-control" id="obj_name" placeholder="имя объекта"/>
  </div>
</template>
<script>
export default {
  props: ['xprops'],
  data: () => ({
    object_name: ''
  }),
  watch: {
    object_name (v) {
      this.xprops.eventbus.$emit('OBJECT_NAME_FILTER', v)
    }
  }
}
</script>
<style>
.th-name-filter-comp {
  display: inline-block;
  margin-bottom: -6px;
}
.th-name-filter-comp > input {
  display: inline-block;
  width: 150px;
  height: 26px;
}
</style>