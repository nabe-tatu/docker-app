<template>
<div>
    <div>
        <v-input placeholder="キーワード検索"></v-input>
    </div>
    <div>
        <NowDoing></NowDoing>
    </div>
    <div>
        <recommend-user></recommend-user>
    </div>
    <div>
        <recommend-topic></recommend-topic>
    </div>
</div>
</template>

<script>
import VInput from "@/component/form/VInput/VInput";
import NowDoing from "@/component/rightbar/NowDoing/NowDoing";
import RecommendUser from "@/component/rightbar/ReccomendUser/RecommendUser";
import RecommendTopic from "@/component/rightbar/ReccomendTopic/RecommendTopic";
export default {
    name: "RightBar",
    components: {RecommendTopic, RecommendUser, NowDoing, VInput}
}
</script>

<style scoped>

</style>
