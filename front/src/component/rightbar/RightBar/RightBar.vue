<template>
<div>
    <div>
<!--        <NowDoing></NowDoing>-->
    </div>
    <div>
        <recommend-user :recommendUsers="recommendUsers"></recommend-user>
    </div>
    <div>
<!--        <recommend-topic></recommend-topic>-->
    </div>
</div>
</template>

<script>
import NowDoing from "@/component/rightbar/NowDoing/NowDoing";
import RecommendUser from "@/component/rightbar/ReccomendUser/RecommendUser";
import RecommendTopic from "@/component/rightbar/ReccomendTopic/RecommendTopic";
export default {
    name: "RightBar",
    components: {RecommendTopic, RecommendUser, NowDoing},
    props: {
        recommendUsers: {
            type: Array,
            require: false,
            default: null
        }
    },
}
</script>

<style scoped>

</style>
