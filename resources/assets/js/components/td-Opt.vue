
<template>
  <div class="btn-group btn-group-sm">
    <a v-bind:href="'/object/' + row.id + '/fact'" class="btn btn-default">
      Факт
    </a>
    <a v-bind:href="'/object/' + row.id + '/plan'" class="btn btn-default disabled">
      План
    </a>
    <a v-bind:href="'/object/' + row.id + '/animal'" class="btn btn-default">
      Сведения о животных
    </a>
    <a v-bind:href="'/object/' + row.id + '/reports'" class="btn btn-default disabled">
      Отчеты
    </a>
    <a v-bind:href="'/object/' + row.id + '/edit'" class="btn btn-default">
      Редактировать
    </a>
  </div>
</template>
<script>
export default {
  props: ['row', 'nested'],
  mounted () {
  },
  computed: {
    
  }
}
</script>