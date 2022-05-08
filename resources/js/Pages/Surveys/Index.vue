<template>
  <div>
    <Head title="Surveys" />
    <h1 class="mb-8 text-3xl font-bold">Surveys</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">

      </search-filter>
      <Link class="btn-indigo" href="/surveys/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Surveys</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">Issued By</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Enteries times</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="surv in surveys.data" :key="surv.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/surveys/${surv.id}/edit`">
                {{ surv.name }}
                <icon v-if="surv.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/surveys/${surv.id}/edit`" tabindex="-1">
                {{ surv.city }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/surveys/${surv.id}/edit`" tabindex="-1">
                Admin
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/surveys/${surv.id}/edit`" tabindex="-1">
                {{ surv.enteries_count }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/surveys/${surv.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="surveys.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No surveys found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="surveys.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    surveys: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/surveys', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
