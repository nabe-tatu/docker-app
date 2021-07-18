<template>
<div>
    <div class="card">
        <div class="card-body">
            <img class="d-inline-block img-fluid rounded-circle pr-3" style="max-height: 50px;max-width: 50px;" src="https://cdn.pixabay.com/photo/2021/06/29/15/56/kingfisher-6374507_1280.jpg">
            <h5 class="d-inline-block card-title">{{ user.attributes.screen_name }}</h5>
            <p class="card-text py-2">{{ user.attributes.profile }}</p>
<!--            <span class="d-inline-block w-25 text-center"><CIcon name="cil-speedometer" height="20"/></span>-->
<!--            <span class="d-inline-block w-25 text-center"><CIcon name="cil-speedometer" height="20"/></span>-->
<!--            <span class="d-inline-block w-25 text-center"><CIcon name="cil-speedometer" height="20"/></span>-->
<!--            <span class="d-inline-block w-25 text-center"><CIcon name="cil-speedometer" height="20"/></span>-->
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "UserCard",
    props: {
        user: {
            type: Object,
            require: false,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
