<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-7">
            <div class="form-horizontal" role="form">
              <div class="form-group">
                <br><br>
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
            <div class="form-horizontal" role="form">
              <div class="form-group">
                <label for="name_search" class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-8">
                  <input type="text" id="name_search" class="form-control" placeholder="Insert asset name here..." v-model="name" @change="filterChanged" />
                </div>
              </div>
              <div class="form-group">
                <label for="sku_search" class="col-sm-3 control-label">SKU:</label>
                <div class="col-sm-8">
                  <input type="text" id="sku_search" class="form-control" placeholder="Insert asset SKU here..." v-model="sku" @change="filterChanged" />
                </div>
              </div>
            </div>
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
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">SKU</th>
              <th scope="col">Quantity</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in data.data" v-if="data.data.length > 0">
              <!-- Image -->
              <td v-if="i.image"><img v-bind:src="'data:image/jpeg;base64,' + i.image" class="img-circle img-responsive" width="50" height="50"></td>
              <td v-else><img src="data:image/jpeg;base64,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" class="img-circle img-responsive" width="50" height="50"></td>
              <!-- Name -->
              <td style="vertical-align: middle;">{{ i.name }}</td>
              <!-- SKU -->
              <td v-if="i.sku" style="vertical-align: middle;">{{ i.sku }}</td>
              <td v-else style="vertical-align: middle;">-</td>
              <!-- Quantity -->
              <td style="vertical-align: middle;">{{ i.quantity }}</td>
              <!-- Category -->
              <td style="vertical-align: middle;">{{ i.category.name }}</td>
              <td style="vertical-align: middle;">
                <form v-bind:action="'' + asset_url + '/' + i.id + '/delete'" method="post">
                  <input type="hidden" name="_token" v-bind:value="'' + csrf + ''" />
    							<a v-bind:href="'' + asset_url + '/' + i.id + '/edit'">
    								<button class="btn btn-primary btn-xs" type="button"><i class="fa fa-edit"></i> Edit</button>
    							</a>
    							<button class="btn btn-danger btn-xs" type="button" @click="deleteAsset(i.name)">
    								<i class="fa fa-trash"></i> Delete
    							</button>
    						</form>
              </td>
            </tr>
            <tr v-if="data.data.length < 1">
              <td scope="row" colspan="6" align="center">
                No Asset Found
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

export default {
    props: ['url', 'asset_url', 'csrf'],
    data: function() {
        return {
            isLoading				: false,
            data					: {
                data				: [],
                links				: {},
                meta				: {},
            },
            name        : null,
            sku         : null,
            per_page    : 10,
            offset		  : 4
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
            deleteAsset(name) {
                event.preventDefault();
                var form = event.target.form;
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete asset (" + name + ")?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Delete"
                        }
                    },
                    dangerMode: true,
                    closeModal: true
                }).then((isConfirm) => {
                    if(isConfirm) {
                        form.submit();
                    }
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
                if(this.name) {
                    params.name = this.name;
                }
                if(this.sku) {
                    params.sku = this.sku;
                }
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
