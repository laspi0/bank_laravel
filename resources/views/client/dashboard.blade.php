@extends('client.app')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow bg-primary text-white">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary-light">
                    <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                  </span>
                </div>
                <div class="col pr-0">
                  <p class="small text-light mb-0">Monthly Sales</p>
                  <span class="h5 mb-0 text-white">{{ $user->balance }}</span>
                  <span class="small text-muted">+5.5%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary">
                    <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                  </span>
                </div>
                <div class="col pr-0">
                  <p class="small text-muted mb-0">Transactions</p>
                  <span class="h5 mb-0">{{ $totalTransactionCount }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary">
                    <i class="fe fe-16 fe-filter text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-0">Conversion</p>
                  <div class="row align-items-center no-gutters">
                    <div class="col-auto">
                      <span class="h3 mr-2 mb-0"> 86.6% </span>
                    </div>
                    <div class="col-md-12 col-lg">
                      <div class="progress progress-sm mt-2" style="height:3px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary">
                    <i class="fe fe-16 fe-activity text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-0">AVG Orders</p>
                  <span class="h3 mb-0">$80</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end section -->
      <div class="container">
        <h2>Derniers dépôts</h2>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Expéditeur</th>
              <th>Montant</th>
              <th>Référence</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lastTransactions as $transaction)
            @if($transaction->receiver_id == $user->id)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $transaction->sender->name }}</td>
              <td>{{ $transaction->amount }}</td>
              <td>{{ $transaction->reference }}</td>
              <td>{{ $transaction->created_at }}</td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>



      <div class="row">
        <!-- Recent Activity -->
        <div class="col-md-6 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title float-left">Recent Activity</strong>
              <a class="float-right small text-muted" href="#!">View all</a>
            </div>
            <div class="card-body">
              <div class="list-group list-group-flush my-n3">
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">
                      <div class="avatar avatar-sm mt-2">
                        <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                      </div>
                    </div>
                    <div class="col">
                      <small><strong>Brown, Asher</strong></small>
                      <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                      <small class="badge badge-light text-muted">1h ago</small>
                    </div>
                  </div>
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">
                      <div class="avatar avatar-sm mt-2">
                        <img src="./assets/avatars/face-2.jpg" alt="..." class="avatar-img rounded-circle">
                      </div>
                    </div>
                    <div class="col">
                      <small><strong>Hester, Nissim</strong></small>
                      <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                      <small class="badge badge-light text-muted">2h ago</small>
                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">
                      <div class="avatar avatar-sm mt-2">
                        <img src="./assets/avatars/face-3.jpg" alt="..." class="avatar-img rounded-circle">
                      </div>
                    </div>
                    <div class="col">
                      <small><strong>Kelley, Sonya</strong></small>
                      <div class="my-0 text-muted small">Created new layout for widgets</div>
                      <small class="badge badge-light text-muted">4h ago</small>
                    </div>
                  </div>
                </div> <!-- / .row -->
              </div> <!-- / .list-group -->
            </div> <!-- / .card-body -->
          </div> <!-- / .card -->
        </div> <!-- / .col-md-3 -->
        <!-- Product List -->
        <div class="col-md-6 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title">Recent Orders</strong>
              <a class="float-right small text-muted" href="#!">View all</a>
            </div>
            <div class="card-body">
              <div class="list-group list-group-flush my-n3">
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                      <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                    </div>
                    <div class="col">
                      <strong>Fusion Backpack</strong>
                      <div class="my-0 text-muted small">Gear, Bags</div>
                    </div>
                    <div class="col-auto">
                      <strong>+85%</strong>
                      <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                      <img src="./assets/products/p2.jpg" alt="..." class="thumbnail-sm">
                    </div>
                    <div class="col">
                      <strong>Luma hoodies</strong>
                      <div class="my-0 text-muted small">Jackets, Men</div>
                    </div>
                    <div class="col-auto">
                      <strong>+75%</strong>
                      <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                      <img src="./assets/products/p3.jpg" alt="..." class="thumbnail-sm">
                    </div>
                    <div class="col">
                      <strong>Luma shorts</strong>
                      <div class="my-0 text-muted small">Shorts, Men</div>
                    </div>
                    <div class="col-auto">
                      <strong>+62%</strong>
                      <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-3 col-md-2">
                      <img src="./assets/products/p4.jpg" alt="..." class="thumbnail-sm">
                    </div>
                    <div class="col">
                      <strong>Brown Trousers</strong>
                      <div class="my-0 text-muted small">Trousers, Women</div>
                    </div>
                    <div class="col-auto">
                      <strong>+24%</strong>
                      <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- / .list-group -->
            </div> <!-- / .card-body -->
          </div> <!-- / .card -->
        </div> <!-- / .col-md-3 -->
      </div> <!-- / .row -->
    </div>
  </div> <!-- .row -->
</div> <!-- .container-fluid -->
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list-group list-group-flush my-n3">
          <div class="list-group-item bg-transparent">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="fe fe-box fe-24"></span>
              </div>
              <div class="col">
                <small><strong>Package has uploaded successfull</strong></small>
                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                <small class="badge badge-pill badge-light text-muted">1m ago</small>
              </div>
            </div>
          </div>
          <div class="list-group-item bg-transparent">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="fe fe-download fe-24"></span>
              </div>
              <div class="col">
                <small><strong>Widgets are updated successfull</strong></small>
                <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                <small class="badge badge-pill badge-light text-muted">2m ago</small>
              </div>
            </div>
          </div>
          <div class="list-group-item bg-transparent">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="fe fe-inbox fe-24"></span>
              </div>
              <div class="col">
                <small><strong>Notifications have been sent</strong></small>
                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                <small class="badge badge-pill badge-light text-muted">30m ago</small>
              </div>
            </div> <!-- / .row -->
          </div>
          <div class="list-group-item bg-transparent">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="fe fe-link fe-24"></span>
              </div>
              <div class="col">
                <small><strong>Link was attached to menu</strong></small>
                <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                <small class="badge badge-pill badge-light text-muted">1h ago</small>
              </div>
            </div>
          </div> <!-- / .row -->
        </div> <!-- / .list-group -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-5">
        <div class="row align-items-center">
          <div class="col-6 text-center">
            <div class="squircle bg-success justify-content-center">
              <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
            </div>
            <p>Control area</p>
          </div>
          <div class="col-6 text-center">
            <div class="squircle bg-primary justify-content-center">
              <i class="fe fe-activity fe-32 align-self-center text-white"></i>
            </div>
            <p>Activity</p>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6 text-center">
            <div class="squircle bg-primary justify-content-center">
              <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
            </div>
            <p>Droplet</p>
          </div>
          <div class="col-6 text-center">
            <div class="squircle bg-primary justify-content-center">
              <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
            </div>
            <p>Upload</p>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6 text-center">
            <div class="squircle bg-primary justify-content-center">
              <i class="fe fe-users fe-32 align-self-center text-white"></i>
            </div>
            <p>Users</p>
          </div>
          <div class="col-6 text-center">
            <div class="squircle bg-primary justify-content-center">
              <i class="fe fe-settings fe-32 align-self-center text-white"></i>
            </div>
            <p>Settings</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection