<template>
    <h1>{{$props.test}}</h1>
</template>
<script>
export default {
    props: ['test'],
    setup(props) {
        console.log(props);
    }
}
</script>
