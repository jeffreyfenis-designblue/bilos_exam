export default {
  enteredMobile (state, payload) {
    state.mobile = payload.status
  },
  userAuthentication (state, payload) {
    state.authenticated = payload.status
  }
}
