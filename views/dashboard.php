          <div class="row">
              <div class="col-12 col-lg-6 col-xl-3">
                  <div class="widget widget-tile">
                      <div class="chart sparkline" id="spark1"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                      <div class="data-info">
                          <div class="desc">Giảng viên</div>
                          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?= $teachers ?>">
                                  <?= count($teachers) ?>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3">
                  <div class="widget widget-tile">
                      <div class="chart sparkline" id="spark2"><canvas width="81" height="35" style="display: inline-block; width: 81px; height: 35px; vertical-align: top;"></canvas></div>
                      <div class="data-info">
                          <div class="desc">Thiết bị</div>
                          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?= $devices ?>">
                                  <?= count($devices) ?>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3">
                  <div class="widget widget-tile">
                      <div class="chart sparkline" id="spark3"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                      <div class="data-info">
                          <div class="desc">Phòng học</div>
                          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right">
                              </span><span class="number" data-toggle="counter" data-end="<?= $classRooms ?>">
                                  <?= count($classRooms) ?>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3">
                  <div class="widget widget-tile">
                      <div class="chart sparkline" id="spark4"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                      <div class="data-info">
                          <div class="desc">Phiếu mượn</div>
                          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right">
                              </span><span class="number" data-toggle="counter" data-end="<?= $transactions ?>">
                                  <?= count($transactions) ?>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12 col-lg-6">
                  <div class="card card-table">
                      <div class="card-header">
                          <div class="tools dropdown"> 
                              
                              <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                              </div>
                          </div>
                          <div class="title">Top 5 thiết bị mượn nhiều nhất</div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-striped table-borderless">
                              <thead>
                                  <tr>
                                      <th >Tên thiết bị</th>
                                      <th style="width:20%;">Số lần mượn</th>
                                      <th>Ngày mượn gần nhất</th>
                                      <th style="width:20%;">Trạng thái</th>
                                  </tr>
                              </thead>
                              <tbody class="no-border-x">
                                  <tr>
                                      <td>Sony Xperia M4</td>
                                      <td >10</td>
                                      <td >7/1/2022</td>
                                      <td class="text-success">Đang rảnh</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-6">
                  <div class="card card-table">
                      <div class="card-header">
                          <div class="tools dropdown">
                              <div class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                              </div>
                          </div>
                          <div class="title">Top 5 giáo viên mượn nhiều thiết bị nhất</div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width:37%;">Tên giảng viên</th>
                                      <th style="width:20%;">Số lần mượn</th>
                                      <th>Ngày mượn gần nhất</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td class="user-avatar"> <img src="/assets/img/avatar6.png" alt="Avatar">Nguyễn Văn A</td>
                                      <td>10</td>
                                      <td>7/12/2022</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

          @script
          <script src="/assets/lib/countup/countUp.min.js" type="text/javascript"></script>
          <script>
              $(document).ready(function() {
                  //-initialize the javascript
                  App.init();
                  App.dashboard();
              });
          </script>
          @endScript