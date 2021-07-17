<template>
  <CDropdown
    inNav
    class="c-header-nav-items"
    placement="bottom-end"
    add-menu-classes="pt-0"
  >

    <template #toggler>
      <CHeaderNavLink>
        <div class="c-avatar">
            <!-- TODO::ヘッダー、アカウントの画像 -->
<!--          <img-->
<!--            src=""-->
<!--            class="c-avatar-img "-->
<!--          />-->
            <CIcon name="cil-settings"/>
        </div>
      </CHeaderNavLink>
    </template>

<!--    <CDropdownHeader tag="div" class="text-center" color="light">-->
<!--      <strong>Account</strong>-->
<!--    </CDropdownHeader>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-bell"/> Updates-->
<!--      <CBadge color="info" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-envelope-open" /> Messages-->
<!--      <CBadge color="success" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-task" /> Tasks-->
<!--      <CBadge color="danger" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-comment-square" /> Comments-->
<!--      <CBadge color="warning" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->

    <CDropdownHeader
      tag="div"
      class="text-center"
      color="light"
    >
      <strong>設定</strong>
    </CDropdownHeader>
    <CDropdownItem>
      <CIcon name="cil-user" /> プロフィール
    </CDropdownItem>
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-settings" /> Settings-->
<!--    </CDropdownItem>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-dollar" /> Payments-->
<!--      <CBadge color="secondary" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-file" /> Projects-->
<!--      <CBadge color="primary" class="mfs-auto">{{ itemsCount }}</CBadge>-->
<!--    </CDropdownItem>-->
    <CDropdownDivider/>
<!--    <CDropdownItem>-->
<!--      <CIcon name="cil-shield-alt" /> Lock Account-->
<!--    </CDropdownItem>-->
    <CDropdownItem @click="logout">
      <CIcon name="cil-lock-locked" /> ログアウト
    </CDropdownItem>
  </CDropdown>
</template>

<script>
export default {
  name: 'TheHeaderDropdownAccnt',
  data () {
    return {
      itemsCount: 42
    }
  },
    methods: {
      logout: function () {
          window.axios.get('/logout', this.form)
              .then((response) => {
                  window.location.href = '/login';
              })
              .catch((error) => {
                  console.log(error);
              })
      }
    }
}
</script>

<style scoped>
  .c-icon {
    margin-right: 0.3rem;
  }
</style>
