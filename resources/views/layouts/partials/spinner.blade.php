<div class="main-spinner"></div>

<style type="text/css">
    .main-spinner,.main-spinner:after{
    width: 100px;
    height: 100px;
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -32px;
    margin-left: -32px;
    border-radius: 50%;
    z-index: 2
 }
.main-spinner {
    /*background-color: rgba(0, 0, 0, .2);*/
    border-top: 10px solid rgb(66,139,202);
    border-right: 10px solid rgb(66,139,202);
    border-bottom: 10px solid rgb(66,139,202);
    /*border-left: 10px solid rgba(66,139,202,.2);*/
    border-left: 10px solid rgba(66,139,202,0);
    transform: translateZ(0);
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-duration: .8s;
    animation-name: spinner-loading
 }
@keyframes spinner-loading{
  0% {
      transform: rotate(0deg)
  } to {
      transform: rotate(1turn)
  }
}
</style>