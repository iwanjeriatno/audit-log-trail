<div class="onboarding-modal modal fade animated" id="modal-{{ $value->id }}" role="dialog" tabindex="-1" aria-hidden="true" style="height:95% !important; overflow-y: scroll;">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span class="os-icon flaticon-multiply"></span></button>
          <div class="onboarding-side-by-side">
                    <div class="element-box">
                        <h6 class="element-header">
                          Detail Log
                        </h6>
                        <div class="timed-activities compact">
                            <div class="timed-activity">
                                <div class="ta-date">
                                    <span>{{ $value->created_at }}</span>
                                </div>
                                <div class="ta-record-w">
                                    <div class="ta-record">
                                        <div class="ta-activity">
                                            {{ $value->event_detail }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
