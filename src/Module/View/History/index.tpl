<?php $app->assetter()->load('datetimepicker'); ?>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h1>
                <i class="fa fa-book"></i>
                {{ t('modNameHistoryLog') }}
            </h1>
        </div>
        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-icon-block btn-link-default" data-toggle="collapse" data-target="#adv-search-form">
                    <i class="fa fa-search"></i>
                    <span>{{ t('search') }}</span>
                </a>
            </div>
        </div>
        <div class="heading-elements-toggle">
            <i class="fa fa-ellipsis-h"></i>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{ createUrl() }}"><i class="fa fa-home"> </i>Verone</a></li>
            <li class="active"><a href="{{ createUrl('HistoryLog', 'HistoryLog', 'index') }}">{{ t('modNameHistoryLog') }}</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
                $request = $app->request();
            ?>
            <form action="" method="get" id="adv-search-form"<?php echo ($request->get('search') != 1 ? ' class="collapse"' : ' class="collapse in"'); ?>>
                <input type="hidden" name="mod" value="HistoryLog" />
                <input type="hidden" name="cnt" value="History" />
                <input type="hidden" name="act" value="index" />
                <input type="hidden" name="entityName" value="{{ $request->query->get('entityName', '') }}" />
                <input type="hidden" name="entityId" value="{{ $request->query->get('entityId', '') }}" />
                <div class="panel panel-default">
                    <div class="panel-heading">{{ t('advancedSearch') }}</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="module" class="control-label">{{ t('module') }}</label>
                                        <select name="module" id="module" class="form-control">
                                            <option value="">-</option>
                                            @foreach $modules
                                                <option value="{{ $item->module }}"<?php echo ($request->get('module') == $item->module ? ' selected="selected"' : ''); ?>>{{ t('modName'.$item->module) }}</option>
                                            @endforeach
                                        </select>
                                        <p class="help-block">{{ t('historyLogLackModuleInfo') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="author" class="control-label">{{ t('author') }}</label>
                                        <select name="author" id="author" class="form-control">
                                            <option value="">-</option>
                                            @foreach $authors
                                                <option value="{{ $item->authorId }}"<?php echo ($request->get('author') == $item->authorId ? ' selected="selected"' : ''); ?>>{{ $item->authorName }}</option>
                                            @endforeach
                                        </select>
                                        <p class="help-block">{{ t('historyLogLackUserInfo') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fromDate" class="control-label">{{ t('historyLogSearchBetween') }}</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">{{ t('from') }}</span>
                                                        <input class="form-control" type="text" id="fromDate" name="fromDate" value="{{ $request->get('fromDate', date('Y-m-d', strtotime('now - 1 month'))) }}" />
                                                        <span class="input-group-addon calendar-open">
                                                            <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">{{ t('to') }}</span>
                                                        <input class="form-control" type="text" id="toDate" name="toDate" value="{{ $request->get('toDate', date('Y-m-d')) }}" />
                                                        <span class="input-group-addon calendar-open">
                                                            <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="#" class="btn btn-success" data-form-submit="adv-search-form" data-form-param="search">{{ t('search') }}</a>
                                <a href="<?php echo $app->createUrl('HistoryLog', 'History', 'index'); ?>" class="btn"><i class="fa fa-remove"></i> {{ t('cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <table class="table table-default">
                <thead>
                    <tr>
                        <th>{{ t('historyLogChangeAuthor') }}</th>
                        <th>{{ t('historyLogModule') }}</th>
                        <th>{{ t('historyLogObjectWithId') }}</th>
                        <th>{{ t('historyLogStatus') }}</th>
                        <th>{{ t('historyLogChangeDate') }}</th>
                        <th class="text-right">{{ t('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @render('relatedChanges.Parts.HistoryLog', [ 'elements' => $elements ])
                </tbody>
            </table>
            <div>{{ $pagination|raw }}</div>
        </div>
    </div>
</div>

<div class="modal fade" id="history-log" tabindex="-1" role="dialog" aria-labelledby="history-log-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ t('close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="history-log-label">{{ t('modNameHistoryLog') }}</h4>
            </div>
            <div class="modal-body">
                <div class="summary-panel history-summary hidden">
                    <div class="history-row">
                        <ul class="change-details"></ul>
                    </div>
                </div>
                <div class="loader hidden">
                    <div class="loader-animate"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#fromDate, #toDate')
            .datetimepicker({format:'YYYY-MM-DD', defaultDate:'<?php echo date('Y-m-d'); ?>'})
            .parent()
            .find('.input-group-addon.calendar-open')
            .click(function() {
                $(this).parent().find('input').trigger('focus');
            });

        $('.btn-main-action').click(function() {
            $('#history-log .history-summary').addClass('hidden');
            $('#history-log .loader').removeClass('hidden');

            $('#history-log').modal();
            $('#history-log h4').text($(this).attr('title'));

            APP.AJAX.call({
                url: $(this).attr('href'),
                success: function(data) {
                    var destination = $('#history-log .history-summary .change-details');
                    destination.html('');

                    if(data.type == 2)
                    {
                        destination.append('<li><p>' + data.log + '</p></li>');
                    }
                    else
                    {
                        for(var i in data.changes)
                        {
                            destination.append('<li class="field-name">' + data.changes[i].field + '</li><li class="changed-value"><span class="from">' + data.changes[i].pre + '</span><span class="to">' + data.changes[i].post + '</span></li>');
                        }
                    }

                    $('#history-log .history-summary').removeClass('hidden');
                    $('#history-log .loader').addClass('hidden');
                }
            });

            return false;
        });

        $('.collapse-relations').click(function() {
            var target = $($(this).attr('data-target'));

            $('.relational-changes')
                .closest('table')
                .find('tr')
                .removeClass('selected');
            $('.relational-changes')
                .not(target)
                .slideUp(200);

            if(target.css('display') == 'none')
            {
                target
                    .slideDown(200)
                    .closest('tr')
                    .prev('tr')
                    .addClass('selected');
            }
            else
            {
                target
                    .slideUp(200);
            }
        });
    });
</script>
<style>
    .relational-changes {background-color:#C2C2C2;border-top:1px solid #DDDDDD;display:none;}
    .relational-changes > div {margin:18px -1px 0 -1px;}
    tr.selected td {font-weight:bold;background-color:#F1F1F1 !important;}
</style>
