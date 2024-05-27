<div
    class="size-12"
    x-data="{
            infinityScroll() {
                const observer = new IntersectionObserver((items) => {
                    items.forEach((item) => {
                        if(item.isIntersecting) {
                            console.log(item)
                            @this.loadMore()
                        }
                    })
                }, {
                    threshold: 0.5, // 0 ... 1
                    rootMargin: '100px'
                })
                observer.observe(this.$el)
            }
        }"
    x-init="infinityScroll()"
></div>
