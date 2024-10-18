<template>
  <div id="app">
    <el-button type="primary">Primary Button</el-button>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { ElButton } from 'element-plus';

export default defineComponent({
  name: 'App',
  components: {
    ElButton,
  },
});
</script>

<style scoped>
#app {
  text-align: center;
  margin-top: 50px;
}
</style>
