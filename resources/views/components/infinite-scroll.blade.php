<div
    class="size-16 mx-auto"
    x-data="{
            infinityScroll() {
                const observer = new IntersectionObserver((items) => {
                    items.forEach((item) => {
                        if(item.isIntersecting) {
                            $wire.loadMore();
                        }
                    })
                }, {
                    threshold: 0.5,
                    rootMargin: '300px'
                })
                observer.observe(this.$el)
            }
        }"
    x-init="infinityScroll()"
></div>
