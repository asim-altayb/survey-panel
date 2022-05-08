<template>
  <div>
    <Head title="Create Survey" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/surveys">Surveys</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/1" label="Name" />

          <label for="" class="pb-8 pr-6 w-full lg:w-3/4">Questions:</label>
          <a class="flex items-center px-6 py-4 focus:text-indigo-500" :href="'#'" @click.prevent="addQuestion">
              Add Question
          </a>
        </div>

      <div v-if="form.questions.length > 0">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8 bg-white rounded-md shadow " v-for="index in questions_count-1" :key="index">
            <text-input v-model="form.questions[index-1].content" class="pb-8 pr-6 w-full lg:w-3/4" label="Question" />
            <select-input v-model="form.questions[index-1].type" class="pb-8 pr-6 w-full lg:w-1/4" label="Question Type">
              <option :value="null" />
              <option value="mutliselect">Mutliselect</option>
              <option value="radio">Radio</option>
            </select-input>
            <label for="" class="pb-8 pr-6 w-full lg:w-3/4">Options:</label>
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.questions[index-1][1]" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
              <text-input v-model="form.questions[index-1][2]" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
              <text-input v-model="form.questions[index-1][3]" class="pb-8 pr-6 w-full lg:w-2/4" label="Option" />
            </div>
          </div>
      </div>


        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Survey</loading-button>
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
      questions_count:0,
      question:{
        content:'',
        type:'mutliselect',
        options:{
          1:'',
          2:'',
          3:'',
        }
      }
    }
  },
  methods: {
    store() {
      this.form.post('/surveys')
    },
    addQuestion() {
      this.questions_count++
      this.form.questions.push(this.question)
    }
  },
  created(){
    this.form.questions.push(this.question)
        this.questions_count++

  }
}
</script>
