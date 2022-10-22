<template>
    <div class="cardlist-container">
        <div class="cardlist-header">
            <img src="http://business.stagingtalenthub.com/images/svg/reward.svg">

            <div class="cardlist-title">
                <div class="title"> {{ title }}</div>
                <div class="subtitle">{{ subtitle }}</div>
            </div>
        </div>

        <div class="container-container">
            <div class="question-list">
                <h4>Question</h4>

                <div class="questions">
                    <div class="question" v-for="question in questionList.questions">
                        {{ question.name }}
                    </div>
                </div>

            </div>


            <div style="width:20%">Score</div>
            <div style="width:20%">Comments</div>

        </div>

        <!--<div style="height: fit-content; width:100%; gap: 10px; background-color: #2d3748; display: flex;">


            <div style="display: flex; gap: 10px; flex-direction: column; flex-wrap: wrap">
                <div v-for="reply in replyList" :key="reply.id"
                     style="height: fit-content; width: fit-content; background-color: lightblue">
                    <div v-for="(childItem, key) in reply">
                        <div>
                            {{ childItem }}
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>

</template>

<script>
import axios from 'axios'

export default {
    name: "card-list",
    props: ['title', 'subtitle'],
    data: function () {
        return {
            questionList: [],
            replyList: [],
        }
    },
    methods: {
        getQuestions() {
            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
            instance.get("/", {})
                .then(function (response) {
                    that.questionList = response.data.data;
                }).catch(error => {
            });
        },

        getReplies() {

            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
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

<style scoped lang="scss">

.cardlist-container {
    width: 100%;

    display: flex;
    flex-direction: column;

    background-color: white;
    //padding: 30px;
    box-shadow: 0 0 15px #0000001F;


    .cardlist-header {
        display: flex;
        height: 15%;
        gap: 10px;
        padding: 30px;

        > img {
            height: 50px;
            width: 50px;
        }

        .cardlist-title {
            display: flex;
            flex-direction: column;
            font-family: system-ui;

            > .title {
                font-size: 20px;
                font-weight: 500;
                letter-spacing: -1px;
            }

            > .subtitle {
                font-size: 16px;
                font-weight: 300;
                letter-spacing: -1px;
            }
        }
    }

    .container-container {
        display: flex;
        flex-direction: row;
        align-items: flex-end;
        height: 100%;

        .question-list {
            width: 60%;
            min-width: fit-content;

            .questions {
                display: flex;
                gap: 10px;
                flex-direction: column;
                flex-wrap: wrap;
                height: 25%;

                .question {
                    height: 25%;
                    width: fit-content;
                    background-color: lightcoral;
                    padding: 20px;
                    border-top: #F7F7F7 solid 2px;
                }
            }

        }
    }


}

</style>
