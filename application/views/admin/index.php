      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Dashboard</h1>
              </div>
              <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                          <div class="card-icon bg-primary">
                              <i class="far fa-user"></i>
                          </div>
                          <div class="card-wrap">
                              <div class="card-header">
                                  <h4>Users</h4>
                              </div>
                              <div class="card-body">
                                  <?=$user_count?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                          <div class="card-icon bg-danger">
                              <i class="fas fa-box"></i>
                          </div>
                          <div class="card-wrap">
                              <div class="card-header">
                                  <h4>Products</h4>
                              </div>
                              <div class="card-body">
                                  <?=$p_count?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                          <div class="card-icon bg-warning">
                              <i class="fas fa-exchange-alt"></i>
                          </div>
                          <div class="card-wrap">
                              <div class="card-header">
                                  <h4>Transaction</h4>
                              </div>
                              <div class="card-body">
                                  <?=$t_count?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                          <div class="card-icon bg-success">
                              <i class="fas fa-circle"></i>
                          </div>
                          <div class="card-wrap">
                              <div class="card-header">
                                  <h4>Payment Process</h4>
                              </div>
                              <div class="card-body">
                                  <?=$pay_count?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- <div class="row">
                  <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Statistics</h4>
                              <div class="card-header-action">
                                  <div class="btn-group">
                                      <a href="#" class="btn btn-primary">Week</a>
                                      <a href="#" class="btn">Month</a>
                                  </div>
                              </div>
                          </div>
                          <div class="card-body">
                              <canvas id="myChart" height="182"></canvas>
                              <div class="statistic-details mt-sm-4">
                                  <div class="statistic-details-item">
                                      <span class="text-muted"><span class="text-primary"><i
                                                  class="fas fa-caret-up"></i></span> 7%</span>
                                      <div class="detail-value">$243</div>
                                      <div class="detail-name">Today's Sales</div>
                                  </div>
                                  <div class="statistic-details-item">
                                      <span class="text-muted"><span class="text-danger"><i
                                                  class="fas fa-caret-down"></i></span> 23%</span>
                                      <div class="detail-value">$2,902</div>
                                      <div class="detail-name">This Week's Sales</div>
                                  </div>
                                  <div class="statistic-details-item">
                                      <span class="text-muted"><span class="text-primary"><i
                                                  class="fas fa-caret-up"></i></span>9%</span>
                                      <div class="detail-value">$12,821</div>
                                      <div class="detail-name">This Month's Sales</div>
                                  </div>
                                  <div class="statistic-details-item">
                                      <span class="text-muted"><span class="text-primary"><i
                                                  class="fas fa-caret-up"></i></span> 19%</span>
                                      <div class="detail-value">$92,142</div>
                                      <div class="detail-name">This Year's Sales</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Recent Activities</h4>
                          </div>
                          <div class="card-body">
                              <ul class="list-unstyled list-unstyled-border">
                                  <li class="media">
                                      <img class="mr-3 rounded-circle" width="50"
                                          src="../assets/img/avatar/avatar-1.png" alt="avatar">
                                      <div class="media-body">
                                          <div class="float-right text-primary">Now</div>
                                          <div class="media-title">Farhan A Mujib</div>
                                          <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                              nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                      </div>
                                  </li>
                                  <li class="media">
                                      <img class="mr-3 rounded-circle" width="50"
                                          src="../assets/img/avatar/avatar-2.png" alt="avatar">
                                      <div class="media-body">
                                          <div class="float-right">12m</div>
                                          <div class="media-title">Ujang Maman</div>
                                          <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                              nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                      </div>
                                  </li>
                                  <li class="media">
                                      <img class="mr-3 rounded-circle" width="50"
                                          src="../assets/img/avatar/avatar-3.png" alt="avatar">
                                      <div class="media-body">
                                          <div class="float-right">17m</div>
                                          <div class="media-title">Rizal Fakhri</div>
                                          <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                              nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                      </div>
                                  </li>
                                  <li class="media">
                                      <img class="mr-3 rounded-circle" width="50"
                                          src="../assets/img/avatar/avatar-4.png" alt="avatar">
                                      <div class="media-body">
                                          <div class="float-right">21m</div>
                                          <div class="media-title">Alfa Zulkarnain</div>
                                          <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                              nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                      </div>
                                  </li>
                              </ul>
                              <div class="text-center pt-1 pb-1">
                                  <a href="#" class="btn btn-primary btn-lg btn-round">
                                      View All
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div> -->
              <div class="row">
                  <div class="col-md-8">
                      <div class="card">
                          <div class="card-header">
                              <h4>Invoices</h4>
                              <div class="card-header-action">
                                  <a href="<?= base_url('transaction')?>" class="btn btn-danger">View More <i
                                          class="fas fa-chevron-right"></i></a>
                              </div>
                          </div>
                          <div class="card-body p-0">
                              <div class="table-responsive table-invoice">
                                  <table class="table table-striped">
                                      <?php $this->db->limit(5);
                                       $this->db->join('user', 'orders.id_user = user.id_user','left');
                                      $orders=$this->db->get('orders')->result_array()
                                      ?>
                                      <tr>
                                          <th>Invoice ID</th>
                                          <th>Customer</th>
                                          <th>Status</th>
                                          <th>Due Date</th>
                                          <th>Action</th>
                                      </tr>

                                      <?php foreach($orders as $o):?>
                                      <tr>
                                          <td><a href="#"><?= $o['id_order']?></a></td>
                                          <td class="font-weight-600"><?= $o['fullname']?></td>
                                          <td>
                                              <div class="badge badge-warning"><?= $o['status']?></div>
                                          </td>
                                          <td><?= $o['date']?></td>
                                          <td>
                                              <a href="#" class="btn btn-primary">Detail</a>
                                          </td>
                                      </tr>
                                      <?php endforeach?>

                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <!-- <div class="card card-hero">
                          <div class="card-header">
                              <div class="card-icon">
                                  <i class="far fa-question-circle"></i>
                              </div>
                              <h4>14</h4>
                              <div class="card-description">Customers need help</div>
                          </div>
                          <div class="card-body p-0">
                              <div class="tickets-list">
                                  <a href="#" class="ticket-item">
                                      <div class="ticket-title">
                                          <h4>My order hasn't arrived yet</h4>
                                      </div>
                                      <div class="ticket-info">
                                          <div>Laila Tazkiah</div>
                                          <div class="bullet"></div>
                                          <div class="text-primary">1 min ago</div>
                                      </div>
                                  </a>
                                  <a href="#" class="ticket-item">
                                      <div class="ticket-title">
                                          <h4>Please cancel my order</h4>
                                      </div>
                                      <div class="ticket-info">
                                          <div>Rizal Fakhri</div>
                                          <div class="bullet"></div>
                                          <div>2 hours ago</div>
                                      </div>
                                  </a>
                                  <a href="#" class="ticket-item">
                                      <div class="ticket-title">
                                          <h4>Do you see my mother?</h4>
                                      </div>
                                      <div class="ticket-info">
                                          <div>Syahdan Ubaidillah</div>
                                          <div class="bullet"></div>
                                          <div>6 hours ago</div>
                                      </div>
                                  </a>
                                  <a href="features-tickets.html" class="ticket-item ticket-more">
                                      View All <i class="fas fa-chevron-right"></i>
                                  </a>
                              </div>
                          </div>
                      </div> -->
                  </div>
              </div>


          </section>
      </div>