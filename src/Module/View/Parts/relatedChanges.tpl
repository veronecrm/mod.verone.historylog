@no-extends

@foreach $elements
    <tr>
        <td>{{ $item->getAuthorName() }}</td>
        <td>{{ t('modName'.$item->getModule()) }}</td>
        <td>{{ $item->getObject() }}<?php if($item->getEntityId()): ?> ({{ $item->getEntityId() }})<?php endif; ?></td>
        <td>{{ t('historyLogStatus'.$item->getStatus()) }}</td>
        <td><?php echo date('Y-m-d H:i:s', $item->getDate()); ?></td>
        <td>
            <div class="actions-box">
                <div class="btn-group right">
                    @if $item->getStatus() != 3
                        <a href="<?php echo $app->createUrl('HistoryLog', 'History', 'entityHistory', [ 'entity' => $item->getEntityName(), 'module' => $item->getModule(), 'entityId' => $item->getEntityId(), 'id' => $item->getId() ]); ?>" class="btn btn-default btn-xs btn-main-action" title="<?php echo $app->t($item->getStatus() == 1 ? 'historyLogInitialValues' : 'historyLogChangesList'); ?>"><i class="fa fa-search"></i> <?php echo $app->t($item->getStatus() == 1 ? 'historyLogShowInitial' : 'historyLogShowChanges'); ?></a>
                    @endif
                    @if $item->relations !== []
                        <button type="button" data-target="#related-with-{{ $item->getId() }}" class="btn btn-default btn-xs collapse-relations">Powiązane</button>
                    @endif
                </div>
            </div>
        </td>
    </tr>
    @if $item->relations !== []
        <tr>
            <td colspan="6" style="padding:0;border-top:none;background-color:#C2C2C2 !important">
                <div class="relational-changes" id="related-with-{{ $item->getId() }}">
                    <div>
                        <table class="table table-default">
                            <tbody>
                                @render('relatedChanges.Parts.HistoryLog', [ 'elements' => $item->relations ])
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr><td colspan="6" style="padding:0;border-top:none;"></tr>
    @endif
@endforeach
