<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-7">
            <div class="form-horizontal" role="form">
              <div class="form-group">
                <label class="col-sm-3 control-label">Result Per Page:</label>
                <div class="col-sm-2 float-left">
                  <select class="col-sm-5 form-control" v-model="per_page" @change="filterChanged">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr>
        <div class="table-responsive">
        <table class="table table-striped table-advance table-hover">
          <thead>
            <tr>
              <th scope="col">Asset Name</th>
              <th scope="col">Borrower</th>
              <th scope="col">Borrowed Quantity</th>
              <th scope="col">Borrowed Date</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in data.data" v-if="data.data.length > 0">
              <!-- Asset Name -->
              <td>{{ i.assets.name }}</td>
              <!-- Borrower -->
              <td>{{ i.users.name }}</td>
              <!-- Borrow Quantity -->
              <td>{{ i.quantity }}</td>
              <!-- Borrowed Date -->
              <td>{{ i.created_at | formattedTime }}</td>
              <!-- Action -->
              <td>
                <span v-if="i.status">
                  Asset Returned
                </span>
                <span v-else>
                  Not Returned Yet
                </span>
              </td>
            </tr>
            <tr v-if="data.data.length < 1">
              <td scope="row" colspan="6" align="center">
                No asset borrowed
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="pagination pull-right" role="navigation">
          <!-- First Page -->
          <li class="page-item" v-if="data.links.prev">
            <a class="page-link" @click=fetchData(data.links.first) rel="first" aria-label="First">&lsaquo;&lsaquo;</a>
          </li>
          <li class="page-item disabled" aria-disabled="true" aria-label="First" v-else>
            <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
          </li>
          <!-- // First Page -->
          <!-- Previous Page -->
          <li class="page-item" v-if="data.links.prev">
            <a class="page-link" @click="fetchData(data.links.prev)" rel="prev" aria-label="Previous">&lsaquo;</a>
          </li>
          <li class="page-item disabled" aria-disabled="true" aria-label="Previous" v-else>
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
          </li>
          <!-- //Previous Page -->
          <!-- Pagination Elements -->
          <li class="page-item" v-for="page in pagesNumber" :class="{'active': page == data.meta.current_page}">
            <a @click="goToPage(page)"><span class="page-link">{{ page }}</span></a>
          </li>
          <!-- //Pagination Elements -->
          <!-- Next Page -->
          <li class="page-item" v-if="data.links.next">
            <a class="page-link" rel="next" aria-label="Next" @click="fetchData(data.links.next)">&rsaquo;</a>
          </li>
          <li class="page-item disabled" aria-disabled="true" aria-label="Next" v-else>
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
          </li>
          <!-- //Next Page -->
          <!-- Last page -->
          <li class="page-item" v-if="data.links.next">
            <a class="page-link" rel="last" aria-label="Last" @click="fetchData(data.links.last)">&rsaquo;&rsaquo;</a>
          </li>
          <li class="page-item disabled" aria-disabled="true" aria-label="Last" v-else>
            <span class="page-link" aria-hidden="true">&rsaquo;&rsaquo;</span>
          </li>
          <!-- // Last Page -->
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import moment from 'moment'

export default {
    props: ['url', 'borrow_url', 'csrf'],
    data: function() {
        return {
            isLoading				: false,
            data					: {
                data				: [],
                links				: {},
                meta				: {},
            },
            per_page    : 10,
            offset		  : 4
        }
    },
    filters: {
        formattedTime: function(date) {
            return moment(String(date)).format('DD/MM/YYYY hh:mm A');
        }
    },
    methods: {
        fetchData: function(url) {
            this.isLoading = true;
            axios.get(url)
                .then((response) => {
                    this.data = response.data;
                }).catch((error) => {
                    alert(error);
                });
            },
            goToPage: function (page) {
                this.isLoading = true;
                let url = this.data.links.first;
                if(url.indexOf('?') !== -1) {
                    url = url + '&page=' + page;
                } else {
                    url = url + '?page=' + page;
                }
                axios.get(url)
                    .then((response) => {
                        this.data = response.data;
                    }).catch((error) => {
                        alert(error);
                    });
            },
            filterChanged: function() {
                let url = this.url;
                var params = {};
                if(this.per_page) {
                    params.per_page = this.per_page;
                }
                let esc = encodeURIComponent;
                let query = Object.keys(params)
                    .map(k => esc(k) + '=' + esc(params[k]))
                    .join('&');
                this.fetchData(url + '?' + query);
            }
        },
        computed: {
            pagesNumber: function () {
                if(!this.data.meta.to) {
                    return [];
                }
                let pagesArray = [];
                let from = this.data.meta.current_page - Math.floor(this.offset / 2);
                if(from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if(to > this.data.meta.last_page) {
                    to = this.data.meta.last_page;
                }
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        mounted() {
            this.fetchData(this.url);
        }
}
</script>
