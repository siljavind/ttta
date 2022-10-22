<template>
    <div class="question-container">
        <div class="question-header">
            <img src="http://business.stagingtalenthub.com/images/svg/reward.svg">
            <div class="title">
                <h1>Strengths</h1>
                <h2>Your three best-performing questions</h2>
            </div>
        </div>

        <div class="question-list" style="display: flex; flex-direction: row; align-items: flex-end; height: 10%">
            <div style="width:60%; min-width: fit-content">Question</div>
            <div style="width:20%">Score</div>
            <div style="width:20%">Comments</div>

        </div>

        <div style="height: fit-content; width:100%; gap: 10px; background-color: #2d3748; display: flex;">
            <div style="display: flex; gap: 10px; flex-direction: column; flex-wrap: wrap">
                <div v-for="question in questionList.questions"
                     style="height: fit-content; width: fit-content; background-color:lightcoral">
                    {{ question.name }}
                </div>
            </div>

            <!--<div style="display: flex; gap: 10px; flex-direction: column; flex-wrap: wrap">
                <div v-for="reply in replyList" :key="reply.id"
                     style="height: fit-content; width: fit-content; background-color: lightblue">
                    <div v-for="(childItem, key) in reply">
                        <div>
                            {{ childItem }}
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>

</template>

<script>
import axios from 'axios'

export default {
    name: "card-list",
    data: function () {
        return {
            questionList: [],
            replyList: [],
        }
    },
    /*props: [
        'header'
    ],*/
    methods: {
        getQuestions() {
            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzQ0OGFjMDllZDRiNzY0ODlhMGEzZWQ2YTczZWVlN2UwNzhjOWE4MTQ1M2VlOTUyZjk5MmMzY2JhNGY3ODA2MTNiMWIxNDVmMDMzZjlkMzQiLCJpYXQiOjE2NDc1Mjg2NjguNzQyNzg5LCJuYmYiOjE2NDc1Mjg2NjguNzQyNzkyLCJleHAiOjE2NzkwNjQ2NjguNzM1NTEyLCJzdWIiOiIyOTciLCJzY29wZXMiOlsiZ2V0LXJlcGxpZXMiLCJnZXQtbWVhc3VyZW1lbnQtZGV0YWlscyIsImdldC1vcmdhbml6YXRpb24tZGV0YWlscyJdfQ.CC5ea4Vam2ZJ0fpuSDT2yLbN2QXibqZmVP1HdRY4awV92C45qQ7mhJFndmP2qok1LRvWgXvN9Imu6xIaDmpeDjnqK_UJZs7DsOIL6oP2RLP6KOp5gJkX_Kbtr3KDFSooWivQvJVU3K5O9QBvDywkQNOQrSWIH5f0E01jc1MKE23FnXWdYT_p2kssc2KpsBbdtwIYdcHwPM7wTHSftMuprmYnSo_mfGD7uWKx3Qun0XjrNDwnfdB5Oulet6hrsgIsI27ezLmtlyORLG8y3aov-P9Nvg6ef_H4x3DoXbcWQ_YttzIoiCXpPBMxHqduLyykFc0oDGsZGztDPeG1h_Uk3MKB9J6_zoHBvA3HfCw2bN4gGSHHv6xISk6QPewyHulc4KDjk1UjMbAxSlxI-APY7a4Z4EWt27A_LhXn_WWnnDr8d24zQ0c7dXkpe6bijFCpwDQ0iWpfpUZha7WFQ4wC2URKUBGmFcOGEF8LkMibLyUITUQc-TR_eFe8gB0cGW6rs1T_-1cz2cKbvQ9aN_n7fVrWmJJpR6aUtj2jHzKmZGKCLmf-dwE6YFxBqqlWf6ct69r2v0vjyc5Edkx1a5upS0-1MnYPySOsYwc90gfzoPHyH_Q8nDIG7JyJ9mFtxJFzwBWja3NL0z-nSrXGokTcBlf-RfHRqm32DjFPYcNDeaA";

            instance.get("/", {})
                .then(function (response) {
                    that.questionList = response.data.data;
                }).catch(error => {
            });


            /*.then(function (response) {
            this.questionList = response.data;
        }).catch(error => {
    });*/
        },
        getReplies() {

            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzQ0OGFjMDllZDRiNzY0ODlhMGEzZWQ2YTczZWVlN2UwNzhjOWE4MTQ1M2VlOTUyZjk5MmMzY2JhNGY3ODA2MTNiMWIxNDVmMDMzZjlkMzQiLCJpYXQiOjE2NDc1Mjg2NjguNzQyNzg5LCJuYmYiOjE2NDc1Mjg2NjguNzQyNzkyLCJleHAiOjE2NzkwNjQ2NjguNzM1NTEyLCJzdWIiOiIyOTciLCJzY29wZXMiOlsiZ2V0LXJlcGxpZXMiLCJnZXQtbWVhc3VyZW1lbnQtZGV0YWlscyIsImdldC1vcmdhbml6YXRpb24tZGV0YWlscyJdfQ.CC5ea4Vam2ZJ0fpuSDT2yLbN2QXibqZmVP1HdRY4awV92C45qQ7mhJFndmP2qok1LRvWgXvN9Imu6xIaDmpeDjnqK_UJZs7DsOIL6oP2RLP6KOp5gJkX_Kbtr3KDFSooWivQvJVU3K5O9QBvDywkQNOQrSWIH5f0E01jc1MKE23FnXWdYT_p2kssc2KpsBbdtwIYdcHwPM7wTHSftMuprmYnSo_mfGD7uWKx3Qun0XjrNDwnfdB5Oulet6hrsgIsI27ezLmtlyORLG8y3aov-P9Nvg6ef_H4x3DoXbcWQ_YttzIoiCXpPBMxHqduLyykFc0oDGsZGztDPeG1h_Uk3MKB9J6_zoHBvA3HfCw2bN4gGSHHv6xISk6QPewyHulc4KDjk1UjMbAxSlxI-APY7a4Z4EWt27A_LhXn_WWnnDr8d24zQ0c7dXkpe6bijFCpwDQ0iWpfpUZha7WFQ4wC2URKUBGmFcOGEF8LkMibLyUITUQc-TR_eFe8gB0cGW6rs1T_-1cz2cKbvQ9aN_n7fVrWmJJpR6aUtj2jHzKmZGKCLmf-dwE6YFxBqqlWf6ct69r2v0vjyc5Edkx1a5upS0-1MnYPySOsYwc90gfzoPHyH_Q8nDIG7JyJ9mFtxJFzwBWja3NL0z-nSrXGokTcBlf-RfHRqm32DjFPYcNDeaA";

            instance.get("/replies/bulk", {})
                .then(function (response) {
                    that.replyList = response.data;
                }).catch(error => {
            });
        },
    },
    mounted() {
        this.getQuestions();
        this.getReplies();
    }
}
</script>

<style scoped>

.question-container {
    width: 100%;

    display: flex;
    flex-direction: column;

    background-color: white;
    padding: 30px;
    box-shadow: 0 0 15px #0000001F;
}

.question-header {
    display: flex;
    height: 15%;
    gap: 10px;
}

.question-header > img {
    height: 50px;
    width: 50px;
}

.title {
    display: flex;
    flex-direction: column;
    font-family: system-ui;
}

.title > h1 {
    font-size: 18px;
    font-weight: 500;
    letter-spacing: -1px;
}

.title > h2 {
    font-size: 18px;
    font-weight: 300;
    letter-spacing: -1px;
}
</style>
