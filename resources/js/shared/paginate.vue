<style>
    .pagination-item {
        padding: 5px 10px;
        cursor: pointer;
        margin-right: 10px;
        border-radius: 5px;
        background-color: #F1EFEF;
    }

    .pagination-item.active {
        background-color: #CCC8AA;
    }
</style>

<template>
    <div style="display: flex;">
        <div v-if="1 < paginateData.currentPage" class="pagination-item" @click="goPage(paginateData.currentPage - 1)">Prev</div>
        <div v-for="page in displayedPages" class="pagination-item" :class="(page == paginateData.currentPage) ? 'active' : ''" @click="goPage(page)">
            {{ page }}
        </div>    
        <div v-if="paginateData.lastPage > paginateData.currentPage" class="pagination-item" @click="goPage(paginateData.currentPage + 1)">Next</div>
    </div>
</template>

<script>
    export default {
        props: {
            paginateData: {}
        },
        data() {
            return {
                displayedPages: []
            }
        },
        watch: {
            paginateData: {
                handler() {
                    this.initPaginate()
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            initPaginate() {
                this.displayedPages = this.generatePagination(this.paginateData.currentPage, this.paginateData.lastPage)
            },
            goPage(page) {
                if (page != this.paginateData.currentPage) {
                    this.$emit('changePage', page)
                }
            },
            generatePagination(currentPage, lastPage) {
                const maxDisplayedPages = 5;
                const pages = [];

                if (lastPage <= maxDisplayedPages) {
                    for (let i = 1; i <= lastPage; i++) {
                        pages.push(i);
                    }

                    return pages;
                } 

                if(currentPage <= 3) {
                    for(let i = 1; i <= 5; i++) {
                        pages.push(i)
                    }

                    return pages;
                }

                const remainingPage = lastPage - currentPage 
                if(remainingPage >= 2) {
                    for(let i = currentPage-2; i <= currentPage+2; i++) {
                        pages.push(i)
                    }

                    return pages;
                }
                
                for(let i = lastPage-4; i <= lastPage; i++) {
                    pages.push(i)
                }
                
                return pages;
            }
        },
        
    }
</script>