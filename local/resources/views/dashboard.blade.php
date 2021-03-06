@extends("layouts/master")
@section('sitetitle', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section("content")
<div class="row">
	<div class="col s12 m12">
		<!-- Requests Statistics -->
		<div class="row">
			<div class="col s12 m10 right">
				<div id="card-stats">
				    <div class="row">
						<!-- View Errors -->
					    @if($errors->any())
					    	@foreach($errors->all() as $error)
					          <p class="errors">{{$error}}</p>
					        @endforeach
					    @endif
				    	<!-- End: View Errors -->
					    @foreach ($statistics as $data)
				        	<div class="col s12 m6 l3">
					        	<div class="card">
					                <div class="card-content
					                	<?php
				                	 		if( trim($data->rfc_stat) == 'Pending') echo 'blue';
						                    elseif( trim($data->rfc_stat) == 'Denied') echo 'red';
						                    elseif( trim($data->rfc_stat) == 'On-Hold') echo 'yellow';
						                    elseif( trim($data->rfc_stat) == 'Approved') echo 'green';
						                    elseif( trim($data->rfc_stat) == 'Cancelled') echo 'grey';
						                    elseif( trim($data->rfc_stat) == 'Reset') echo 'purple';
					                    ?>
					                white-text">
					                    <p class="card-stats-title"><i class="material-icons left">
					                    @if( trim($data->rfc_stat) == 'Pending')thumbs_up_down
					                    @elseif( trim($data->rfc_stat) == 'Denied')thumb_down
					                    @elseif( trim($data->rfc_stat) == 'On-Hold')pause_circle_outline
					                    @elseif( trim($data->rfc_stat) == 'Approved')thumb_up
					                    @elseif( trim($data->rfc_stat) == 'Cancelled')not_interested
					                    @elseif( trim($data->rfc_stat) == 'Reset')restore
					                    @endif
					                    </i>{{trim($data->rfc_stat)}} Requests</p>
					                    <h4 class="card-stats-number center-align">{{trim($data->total)}}</h4>
					                    <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span class="green-text text-lighten-5">from yesterday</span> 
					                    </p>-->
					                </div>
					                <div class="card-action
					                	<?php
				                	 		if( trim($data->rfc_stat) == 'Pending') echo 'blue';
						                    elseif( trim($data->rfc_stat) == 'Denied') echo 'red';
						                    elseif( trim($data->rfc_stat) == 'On-Hold') echo 'yellow';
						                    elseif( trim($data->rfc_stat) == 'Approved') echo 'green';
						                    elseif( trim($data->rfc_stat) == 'Cancelled') echo 'grey';
						                    elseif( trim($data->rfc_stat) == 'Reset') echo 'purple';
					                    ?>
					                darken-2">
					                    <div id="clients-bar"><canvas width="290" height="25" style="display: inline-block; width: 290px; height: 25px; vertical-align: top;"></canvas></div>
					                </div>
					            </div>
				        	</div>
				        @endforeach
				    </div>
				</div>
			</div>
		</div>
		<!-- End: Requests Statistics -->

		<!-- Requests Table Container -->
		<!-- Table Label -->
		<div class="row">
			<div class="col s11 m10 right">
				<h5 class="left-align">Unsigned Requests
					@if($statistics_unsigned->total > 0)
						<em class="red-text">({{$statistics_unsigned->total}})</em>
					@endif
				</h5>
			</div>
		</div>
		<!-- End: Table Label -->

    	<!-- Search Field -->
	    @if($statistics_unsigned->total > 0)
	    <div class="row">
	      <div class="col s12 m3 right">	
	        <form action="<?php route('dashboard') ?>" method="get">
	          <div class="input-field">
	            <input type="search" id="search-field" class="field" required maxlength="" name="search">
	            <label for="search-field"><i class="mdi-action-search"></i></label>
	            <i class="mdi-navigation-close close"></i>
	          </div>
	        </form>
	      </div>
	    </div>
	    @endif
	    <!-- End: Search Field -->

		<!-- TABS -->
		<div class="row">
		    <div class="col s12 m10 right">
		      <ul class="tabs">
		        <li class="tab col s3"><a class="active" href="#unsignedPendingRequestTab">Unsigned Pending Requests</a></li>
		        <li class="tab col s3"><a href="#unsignedOnHoldRequestTab">Unsigned On-Hold Requests</a></li>
		      </ul>
		    </div>
		    <!-- Unsigned Pending Request Tab -->
		    <div id="unsignedPendingRequestTab" class="row">

		    	<!-- Request Table -->
				 @if ($pending_requests->count()>0)
					<div class="row">
						<div class="col s12 m10 right">
							<table class="responsive-table hoverable">
								<thead class="">
									<tr>
										<th data-field="code" class="center-align">
											 Code
										</th>
										<th data-field="owners_name" class="center-align">
											 Owner's Name
										</th>
										<th data-field="project_name" class="center-align">
											 Project Name
										</th>
										<th data-field="lot_code" class="center-align">
											 Lot Code
										</th>
										<th data-field="payment_scheme" class="center-align">
											 Payment Scheme
										</th>
										<th data-field="qualification_date" class="center-align">
											 Qualification Date
										</th>
										<th data-field="date_filed" class="center-align">
											 Date Filed
										</th>
										<th data-field="actions" class="center-align">
											 Actions
										</th>
									</tr>
								</thead>
								<tbody>
					              @foreach ($pending_requests as $pending_request)
					                <tr>
					                  <td>{{ trim($pending_request->rfc_code) }}</td>
					                  <td>{{ trim($pending_request->rfc_name) }}</td>
					                  <td>{{ trim($pending_request->project_no) }}</td>
					                  <td>{{ trim($pending_request->lot_no) }}</td>
					                  <td>{{ trim($pending_request->rfc_scheme) }}</td>
					                  <td>
					                  	@if($pending_request->rfc_alertdate)
					                      {{ date('m/d/Y', strtotime(trim($pending_request->rfc_alertdate))) }}
					                    @endif
					                  </td>
					                  <td>
					                  	@if($pending_request->rfc_DOR)
					                      {{ date('m/d/Y', strtotime(trim($pending_request->rfc_DOR))) }}
					                    @endif
					                  </td>
					                  <td>
					                    <a href="{{ route('request.show', trim($pending_request->rfc_code) ) }}">View</a>
					                    <!-- <a class="modal-trigger" href="#modal_remarks">Approve</a> -->
					                  <!-- <a href="#">Approve</a><a href="#">Hold</a><a href="#">Deny</a> --></td>
					                </tr>
					              @endforeach
					            </tbody>
							</table>
						</div>
					</div>
				@else
		          <div class="center-align">All taken cared of.</div>
		        @endif
				<!-- End: Request Table -->

				<!-- Pagination -->
				<div class="col s12 m10 right">
					<ul class="pagination right">
						<?php echo $pending_requests->setPageName('pending_request_page'); ?>
					</ul>
				</div>
				<!-- End: Pagination -->
		    </div>
		    <!-- End: Unsigned Pending Request Tab -->
		    <!-- Unsigned On-Hold Request Tab -->
		   	<div id="unsignedOnHoldRequestTab" class="row">
		    	<!-- Request Table -->
				 @if ($onhold_requests->count()>0)
					<div class="row">
						<div class="col s12 m10 right">
							<table class="responsive-table hoverable">
								<thead class="">
									<tr>
										<th data-field="code" class="center-align">
											 Code
										</th>
										<th data-field="owners_name" class="center-align">
											 Owner's Name
										</th>
										<th data-field="project_name" class="center-align">
											 Project Name
										</th>
										<th data-field="lot_code" class="center-align">
											 Lot Code
										</th>
										<th data-field="payment_scheme" class="center-align">
											 Payment Scheme
										</th>
										<th data-field="qualification_date" class="center-align">
											 Qualification Date
										</th>
										<th data-field="date_filed" class="center-align">
											 Date Filed
										</th>
										<th data-field="actions" class="center-align">
											 Actions
										</th>
									</tr>
								</thead>
								<tbody>
					              @foreach ($onhold_requests as $onhold_request)
					                <tr>
					                  <td>{{ trim($onhold_request->rfc_code) }}</td>
					                  <td>{{ trim($onhold_request->rfc_name) }}</td>
					                  <td>{{ trim($onhold_request->project_no) }}</td>
					                  <td>{{ trim($onhold_request->lot_no) }}</td>
					                  <td>{{ trim($onhold_request->rfc_scheme) }}</td>
					                  <td>
					                  	@if($onhold_request->rfc_alertdate)
					                      {{ date('m/d/Y', strtotime(trim($onhold_request->rfc_alertdate))) }}
					                    @endif
					                  </td>
					                  <td>
					                  	@if($onhold_request->rfc_DOR)
					                      {{ date('m/d/Y', strtotime(trim($onhold_request->rfc_DOR))) }}
					                    @endif
					                  </td>
					                  <td>
					                    <a href="{{ route('request.show', trim($onhold_request->rfc_code) ) }}">View</a>
					                    <!-- <a class="modal-trigger" href="#modal_remarks">Approve</a> -->
					                  <!-- <a href="#">Approve</a><a href="#">Hold</a><a href="#">Deny</a> --></td>
					                </tr>
					              @endforeach
					            </tbody>
							</table>
						</div>
					</div>
				@else
		          <div class="center-align">All taken cared of.</div>
		        @endif
				<!-- End: Request Table -->

				<!-- Pagination -->
				<div class="col s12 m10 right">
					<ul class="pagination right">
						<?php echo $onhold_requests->setPageName('onhold_request_page'); ?>
					</ul>
				</div>
				<!-- End: Pagination -->
		    </div>
		    <!-- End: Unsigned On-Hold Request Tab -->
		 </div>
		<!-- End: TABS -->

		<!-- Modal Structure -->
        <div id="modal_action" class="modal">
          <div class="modal-content">
          	<form>
          		 <div id="remarks" class="row">
			        <div class="col s12 m8">
			          <h5>Remarks:</h5>
			          <div class="row">
			            <div class="input-field col s12 m10">
			              <textarea id="remarks" class="materialize-textarea"></textarea>
			              <label for="remarks">Input remarks.</label>
			            </div>
			          </div>
			        </div>
			      </div>
          	</form>
          </div>
          <div style="clear:both;">
          </div>
          <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Back</a>
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
          </div>
        </div>
	      <!-- End: Modal Structure -->

		<!-- End: Requests Table Container-->
	</div>
</div>
@stop

