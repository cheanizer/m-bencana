<div class="module-foot clearfix">
    <div class="row">
        <div class="span3">
        {!! __('Showing page <em>:currentPage</em> of <em>:totalPage</em>. Total <strong>:total</strong> data.', ['currentPage' => $paginator->currentPage(), 'totalPage' => $paginator->lastPage(), 'total' =>  $paginator->total()]) !!}
        </div>
        <div class="pagination span5 pagination-right pull-right" style="margin: 0px">
            {!! $paginator->appends(app('request')->all())->links('vendor.pagination.default')!!}
                </div>
    </div>


</div>
