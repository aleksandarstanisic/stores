{{ ($order->status->name === 'confirmed' || $order->status->name === 'sent' || $order->status->name === 'paused') ? 'info' : ''}}{{ ($order->status->name === 'canceled' || $order->status->name === 'not_sent' || $order->status->name === 'declined') ? 'danger' : '' }}{{ ($order->status->name === 'delivered') ? 'success' : '' }}{{ ($order->status->name === 'deleted') ? 'warning' : '' }}