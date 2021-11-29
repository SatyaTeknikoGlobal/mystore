
@include('admin.common.header')

<!-- ////////////////////////////////////////Content -->

<div class="main-panel">
  <!-- BEGIN : Main Content-->
  <div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper"><!--Statistics cards Starts-->
      <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
          <div class="card gradient-purple-love">
            <div class="card-content">
              <div class="card-body py-0">
                <div class="media pb-1">
                  <div class="media-body white text-left">
                    <h3 class="font-large-1 white mb-0"><i class="fa fa-user"></i> {{$total_user}}</h3>
                    <span>Total User</span>
                  </div>
                  <div class="media-right white text-right">
                    <i class="ft-activity font-large-1"></i>
                  </div>
                </div>
              </div>
              <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
          <div class="card gradient-ibiza-sunset">
            <div class="card-content">
              <div class="card-body py-0">
                <div class="media pb-1">
                  <div class="media-body white text-left">
                    <h3 class="font-large-1 white mb-0">{{$total_order}}</h3>
                    <span>Total Order</span>
                  </div>
                  <div class="media-right white text-right">
                    <i class="ft-percent font-large-1"></i>
                  </div>
                </div>
              </div>
              <div id="Widget-line-chart1" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
              </div>

            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
          <div class="card gradient-mint">
            <div class="card-content">
              <div class="card-body py-0">
                <div class="media pb-1">
                  <div class="media-body white text-left">
                    <h3 class="font-large-1 white mb-0"><i class="fa fa-user"></i> {{$total_vendors}}</h3>
                    <span>Total Vendors</span>
                  </div>
                  <div class="media-right white text-right">
                    <i class="ft-trending-up font-large-1"></i>
                  </div>
                </div>
              </div>
              <div id="Widget-line-chart2" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
          <div class="card gradient-king-yna">
            <div class="card-content">
              <div class="card-body py-0">
                <div class="media pb-1">
                  <div class="media-body white text-left">
                    <h3 class="font-large-1 white mb-0">₹ {{$total_revenue}}</h3>
                    <span>Total Revenue</span>
                  </div>
                  <div class="media-right white text-right">
                    <i class="ft-credit-card font-large-1"></i>
                  </div>
                </div>
              </div>
              <div id="Widget-line-chart3" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
              </div>
            </div>
          </div>
        </div>
      </div>










      <!-- ////////////////////////////////////////Content -->



      @include('admin.common.footer')