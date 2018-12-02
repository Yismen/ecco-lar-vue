<template>
    <a href="#" @click.prevent="$modal.show(modalName)" :class="className">
        <i class="fa fa-plus"></i> Add
    </a>
</template>

<script>
export default {

  name: 'AddButton',

  props: {
    className: {type: String},
    modalName: {type: String, required: true}
  }
}
</script>

<style lang="css" scoped>
</style>