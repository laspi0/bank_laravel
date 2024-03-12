@extends('accounts.app')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
          <div class="card shadow bg-warning text-white">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary-light">
                    <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                  </span>
                </div>
                <div class="col pr-0">
                  <p class="small text-light mb-0">Nombre clients</p>
                  <span class="h5 mb-0 text-white">{{ $countClients }} </span>
                  <span class="small text-light"></span>
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
                  <p class="small text-muted mb-0">Nombre de guichetiers</p>
                  <span class="h5 mb-0">{{ $countTellers }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-6 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-3 text-center">
                  <span class="circle circle-sm bg-primary">
                    <i class="fe fe-16 fe-filter text-white mb-0"></i>
                  </span>
                </div>
                <div class="col">
                  <p class="small text-muted mb-0">Somme de tout les comptes</p>
                  <div class="row align-items-center no-gutters">
                    <div class="col-auto">
                      <span class="h3 mr-2 mb-0">{{ $totalBalance }} FCFA</span>
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
        <!-- <div class="container"> -->
      </div>

      <div class="mb-2 align-items-center">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mt-1 align-items-center">
                <div class="col-12 col-lg-4 text-left pl-4">
                    <p class="mb-1 small text-muted">Annuel</p>
                    <span class="h3">{{ $annualBalance }}FCFA</span>
                    <span class="small text-muted">+20%</span>
                    <span class="fe fe-arrow-up text-success fe-12"></span>
                </div>
                <div class="col-6 col-lg-2 text-center py-4">
                    <p class="mb-1 small text-muted">Aujourd'hui</p>
                    <span class="h3">{{ $dailyTransactions }} FCFA</span><br />
                    <span class="small text-muted">+20%</span>
                    <span class="fe fe-arrow-up text-success fe-12"></span>
                </div>
                <div class="col-6 col-lg-2 text-center py-4 mb-2">
                    <p class="mb-1 small text-muted">Mensuel</p>
                    <span class="h3">{{ $monthlyTransactions }}</span><br />
                    <span class="small text-muted">+6%</span>
                    <span class="fe fe-arrow-up text-success fe-12"></span>
                </div>
                <div class="col-6 col-lg-2 text-center py-4">
                    <p class="mb-1 small text-muted">Transactions</p>
                    <span class="h3">{{ $totalTransactions }}</span><br />
                    <span class="small text-muted">+20%</span>
                    <span class="fe fe-arrow-up text-success fe-12"></span>
                </div>
                <div class="col-6 col-lg-2 text-center py-4">
                    <p class="mb-1 small text-muted">Conversion</p>
                    <span class="h3">6%</span><br />
                    <span class="small text-muted">+2%</span>
                    <span class="fe fe-arrow-down text-danger fe-12"></span>
                </div>
            </div>
            <div class="map-box">
                <div id="areaChart"></div>
            </div>
        </div> <!-- .card-body -->
    </div> <!-- .card -->
</div>


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