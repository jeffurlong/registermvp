<?php include __DIR__.'/../partials/header.php'; ?>

<div class="page-header">
    <h1 class="page-header-title">
        <i class="glyphicon glyphicon-credit-card"></i> Payment Settings
    </h1>
</div>

<div class="page-body page-body-narrow container">

    <?php if ($_org['payment_processor'] === 'stripe'): ?>

        <div class="panel stripe-payments-panel">
            <div class="panel-body">
                <h2>Stripe</h2>
                <p class="lead">
                    You are currently using Stripe to process your transactions.
                    <a target="_blank" href="https://manage.stripe.com/login">Sign in to Stripe</a>
                    to manage that account.
                </p>
            </div>

            <div class="panel-footer">
                <div class="text-right">
                    <button class="btn btn-lg btn-default" data-toggle="collapse"
                        data-target="#stripe-update-panel">Edit</button>
                </div>

                 <div class="collapse panel panel-default mt" id="stripe-update-panel">

                    <div class="panel-body">
                        <p>If you would like to use a different supported payment processor,
                            deactivate Stripe using the button below.
                    </div>
                    <div class="panel-footer">
                        <form method="post">
                            <input type="hidden" name="payment_processor" value="" />
                            <input type="hidden" name="_method" value="PUT" />
                            <?php echo Form::token(); ?>
                            <button class="btn btn-danger" type="submit"
                                data-act="deactivate-payment-processor">
                                <i class="glyphicon glyphicon-remove"></i> Deactivate
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <?php elseif($_org['payment_processor'] === 'authnet'): ?>
        <div class="panel authorizenet-payments-panel">

            <div class="panel-body">
                <h2>Authorize.net</h2>
                <p class="lead">You are currently using Authorize.net to process your transactions.
                    <a target="_blank" href="https://account.authorize.net/">Sign in to Authorize.net</a>
                to manage that account.</p>
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <button class="btn btn-lg btn-default" data-toggle="collapse"
                        data-target="#authnet-update-panel">Edit</button>
                </div>


                <div class="collapse panel panel-default mt" id="authnet-update-panel">
                    <div class="panel-heading"><h4>Authorize.net credentials</h4></div>

                    <div class="panel-body">
                        <form id="authnet-form" method="post">
                            <label class="control-label" for="authnet-login">
                                API Login ID <span class="required">(required)</span>
                            </label>
                            <input class="form-control required" id="authnet-login" name="authnet_api_login"
                                type="text" value="<?php echo $authnet_api_login; ?>" />

                            <label class="control-label" for="authnet-key">
                                Transaction Key <span class="required">(required)</span>
                            </label>
                            <input class="form-control required" id="authnet-key" name="authnet_transaction_key"
                                type="text" value="<?php echo $authnet_transaction_key; ?>" />

                            <input name="payment_processor" type="hidden" value="authnet" />
                            <input name="_method" type="hidden" value="PUT">
                            <?php echo Form::token(); ?>

                            <div class="form-group form-group-actions">
                                <button class="pull-left btn btn-danger" type="button"
                                    data-act="deactivate-payment-processor">
                                    <i class="glyphicon glyphicon-remove"></i> Deactivate
                                </button>
                                <button class="pull-right btn btn-success" type="submit">
                                    <i class="glyphicon glyphicon-ok"></i> Save Changes
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="well stripe-payments-well">
            <h2>Stripe</h2>
            <p>Stripe is a third-party payments provider with a very simple fee structure: just 2.9% and
                30 cents for each transaction, no hidden costs, and no other gateway or merchant account
                is required. To use Stripe to process your MVP transactions, you'll need to complete the
                Stripe account setup by providing them with a bit more information about your business.
            </p>
            <h3>
                <a class="btn btn-link btn-xl"
                    href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=<?php echo $client_id; ?>&scope=read_write&state=<?php echo $_org['slug']; ?>">
                    <i class="glyphicon glyphicon-ok-circle"></i> Use Stripe to process payments
                </a>
            </h3>
        </div>

        <div class="well authorizenet-payments-well">
            <h2>Authorize.net</h2>
            <p>Authorize.net is a third-party payment gateway that works in conjunction with your
                merchant account. The fees vary and are set by your Merchant Account provider. To use
                Authorize.net to process your MVP transactions, you'll need your Authnet API Login and
                Transaction Key. If you don't know what these are, contact your Merchant Account
                provider for assistance.</p>
            <h3>
                <a class="btn btn-xl btn-link" data-toggle="collapse" data-target="#authnet-panel">
                    <i class="glyphicon glyphicon-ok-circle"></i> Use Authorize.net to process payments
                </a>
            </h3>
            <div class="collapse panel panel-info" id="authnet-panel">
                <div class="panel-heading"><h4 class="panel-title">Authorize.net credentials</h4></div>
                <div class="panel-body">
                    <form id="authnet-form" method="post">
                        <label class="control-label" for="authnet-login">
                            API Login ID<span class="required">(required)</span>
                        </label>
                        <input class="form-control required" id="authnet-login" name="authnet_api_login"
                            type="text" value="<?php echo $authnet_api_login; ?>" />

                        <label class="control-label" for="authnet-key">
                            Transaction Key <span class="required">(required)</span>
                        </label>
                        <input class="form-control required" id="authnet-key" name="authnet_transaction_key"
                            type="text" value="<?php echo $authnet_transaction_key; ?>" />

                        <input name="payment_processor" type="hidden" value="authnet" />
                        <input name="_method" type="hidden" value="PUT">
                        <?php echo Form::token(); ?>

                        <div class="form-group">
                            <button class="pull-left btn btn-default" type="button"
                                data-toggle="collapse" data-target="#authnet-panel">
                                <i class="glyphicon glyphicon-cancel"></i> Cancel
                            </button>
                            <button class="pull-right btn btn-success" type="submit">
                                <i class="glyphicon glyphicon-ok"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>





<?php  include __DIR__.'/../partials/footer.php'; ?>
