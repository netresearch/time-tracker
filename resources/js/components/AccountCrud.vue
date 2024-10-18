<template>
  <div>
    <el-button type="primary" @click="showCreateDialog = true">Create Account</el-button>
    <el-dialog :visible.sync="showCreateDialog" title="Create Account">
      <el-form :model="newAccount">
        <el-form-item label="Name">
          <el-input v-model="newAccount.name"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showCreateDialog = false">Cancel</el-button>
        <el-button type="primary" @click="createAccount">Create</el-button>
      </div>
    </el-dialog>

    <el-table :data="accounts">
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column label="Actions">
        <template slot-scope="scope">
          <el-button size="mini" @click="editAccount(scope.row)">Edit</el-button>
          <el-button size="mini" type="danger" @click="deleteAccount(scope.row.id)">Delete</el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog :visible.sync="showEditDialog" title="Edit Account">
      <el-form :model="currentAccount">
        <el-form-item label="Name">
          <el-input v-model="currentAccount.name"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showEditDialog = false">Cancel</el-button>
        <el-button type="primary" @click="updateAccount">Update</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue';
import { ElTable, ElTableColumn, ElButton, ElDialog, ElForm, ElFormItem, ElInput } from 'element-plus';
import axios from 'axios';

export default defineComponent({
  name: 'AccountCrud',
  components: {
    ElTable,
    ElTableColumn,
    ElButton,
    ElDialog,
    ElForm,
    ElFormItem,
    ElInput,
  },
  setup() {
    const accounts = ref([]);
    const newAccount = ref({ name: '' });
    const currentAccount = ref({});
    const showCreateDialog = ref(false);
    const showEditDialog = ref(false);

    const fetchAccounts = async () => {
      const response = await axios.get('/api/accounts');
      accounts.value = response.data;
    };

    const createAccount = async () => {
      await axios.post('/api/accounts', newAccount.value);
      fetchAccounts();
      showCreateDialog.value = false;
      newAccount.value = { name: '' };
    };

    const editAccount = (account) => {
      currentAccount.value = { ...account };
      showEditDialog.value = true;
    };

    const updateAccount = async () => {
      await axios.put(`/api/accounts/${currentAccount.value.id}`, currentAccount.value);
      fetchAccounts();
      showEditDialog.value = false;
    };

    const deleteAccount = async (id) => {
      await axios.delete(`/api/accounts/${id}`);
      fetchAccounts();
    };

    onMounted(fetchAccounts);

    return {
      accounts,
      newAccount,
      currentAccount,
      showCreateDialog,
      showEditDialog,
      fetchAccounts,
      createAccount,
      editAccount,
      updateAccount,
      deleteAccount,
    };
  },
});
</script>

<style scoped>
.dialog-footer {
  text-align: right;
}
</style>
