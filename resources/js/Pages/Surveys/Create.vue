<template>
  <div>
    <Head title="Create Organization" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/surveys">Surveys</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/1" label="Name" />

          <label for="" class="pb-8 pr-6 w-full lg:w-3/4">Questions:</label>
          <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="'#'">
              Add Question
          </Link>
        </div>

        <div class="flex flex-wrap -mb-8 -mr-6 p-8 bg-white rounded-md shadow " v-for="index in questions_count" :key="index">
          <text-input v-model="form.questions[index]['content']" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-3/4" label="Question" />
          <select-input v-model="form.questions[index].type" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/4" label="Question Type">
            <option :value="null" />
            <option value="mutliselect">Mutliselect</option>
            <option value="radio">Radio</option>
          </select-input>
          <label for="" class="pb-8 pr-6 w-full lg:w-3/4">Options:</label>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <text-input v-model="form.questions[index]['content']" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
            <text-input v-model="form.questions[index]['content']" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
            <text-input v-model="form.questions[index]['content']" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
            <text-input v-model="form.questions[index]['content']" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
          </div>
        </div>

        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Organization</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        questions:[]
      }),
      questions_count:1
    }
  },
  methods: {
    store() {
      this.form.post('/surveys')
    },
  },
}
</script>
