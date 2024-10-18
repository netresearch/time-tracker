<template>
  <div>
    <el-button type="primary" @click="showCreateDialog = true">Create Activity</el-button>
    <el-dialog :visible.sync="showCreateDialog" title="Create Activity">
      <el-form :model="newActivity">
        <el-form-item label="Name">
          <el-input v-model="newActivity.name"></el-input>
        </el-form-item>
        <el-form-item label="Needs Ticket">
          <el-switch v-model="newActivity.needs_ticket"></el-switch>
        </el-form-item>
        <el-form-item label="Factor">
          <el-input v-model="newActivity.factor" type="number"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showCreateDialog = false">Cancel</el-button>
        <el-button type="primary" @click="createActivity">Create</el-button>
      </div>
    </el-dialog>

    <el-table :data="activities">
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="needs_ticket" label="Needs Ticket"></el-table-column>
      <el-table-column prop="factor" label="Factor"></el-table-column>
      <el-table-column label="Actions">
        <template slot-scope="scope">
          <el-button size="mini" @click="editActivity(scope.row)">Edit</el-button>
          <el-button size="mini" type="danger" @click="deleteActivity(scope.row.id)">Delete</el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog :visible.sync="showEditDialog" title="Edit Activity">
      <el-form :model="currentActivity">
        <el-form-item label="Name">
          <el-input v-model="currentActivity.name"></el-input>
        </el-form-item>
        <el-form-item label="Needs Ticket">
          <el-switch v-model="currentActivity.needs_ticket"></el-switch>
        </el-form-item>
        <el-form-item label="Factor">
          <el-input v-model="currentActivity.factor" type="number"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showEditDialog = false">Cancel</el-button>
        <el-button type="primary" @click="updateActivity">Update</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue';
import { ElTable, ElTableColumn, ElButton, ElDialog, ElForm, ElFormItem, ElInput, ElSwitch } from 'element-plus';
import axios from 'axios';

export default defineComponent({
  name: 'ActivityCrud',
  components: {
    ElTable,
    ElTableColumn,
    ElButton,
    ElDialog,
    ElForm,
    ElFormItem,
    ElInput,
    ElSwitch,
  },
  setup() {
    const activities = ref([]);
    const newActivity = ref({ name: '', needs_ticket: false, factor: 1 });
    const currentActivity = ref({});
    const showCreateDialog = ref(false);
    const showEditDialog = ref(false);

    const fetchActivities = async () => {
      const response = await axios.get('/api/activities');
      activities.value = response.data;
    };

    const createActivity = async () => {
      await axios.post('/api/activities', newActivity.value);
      fetchActivities();
      showCreateDialog.value = false;
      newActivity.value = { name: '', needs_ticket: false, factor: 1 };
    };

    const editActivity = (activity) => {
      currentActivity.value = { ...activity };
      showEditDialog.value = true;
    };

    const updateActivity = async () => {
      await axios.put(`/api/activities/${currentActivity.value.id}`, currentActivity.value);
      fetchActivities();
      showEditDialog.value = false;
    };

    const deleteActivity = async (id) => {
      await axios.delete(`/api/activities/${id}`);
      fetchActivities();
    };

    onMounted(fetchActivities);

    return {
      activities,
      newActivity,
      currentActivity,
      showCreateDialog,
      showEditDialog,
      fetchActivities,
      createActivity,
      editActivity,
      updateActivity,
      deleteActivity,
    };
  },
});
</script>

<style scoped>
.dialog-footer {
  text-align: right;
}
</style>
