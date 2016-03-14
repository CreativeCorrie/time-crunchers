<div class="row">
	<div class="col-md-6">
		<form>
			<h4>Popup</h4>
			<div class="row">
				<div class="col-md-6">
					<p class="input-group">
						<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="dt"
								 is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true"
								 close-text="Close" alt-input-formats="altInputFormats"/>
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="open1()"><i
						class="glyphicon glyphicon-calendar"></i></button>
          </span>
					</p>
				</div>
			</div>
		</form>
	</div>
</div>