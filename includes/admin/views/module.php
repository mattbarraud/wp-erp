<?php

$tab                = isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ? $_GET['tab'] : false;
$modules            = wperp()->modules->get_query_modules( $tab );
$all_active_modules = wperp()->modules->get_active_modules();
$count_all          = count( wperp()->modules->get_modules() );
$count_active       = count( $all_active_modules );
$count_inactive     = count( wperp()->modules->get_inactive_modules() );

$all_url            = admin_url( 'admin.php/?page=erp-modules' );
$active_url         = admin_url( 'admin.php/?page=erp-modules&tab=active' );
$inactive_url       = admin_url( 'admin.php/?page=erp-modules&tab=inactive' );

$all_color          = ! $tab ? 'erp-nav-tab-active' : '';
$active_color       = $tab == 'active' ? 'erp-nav-tab-active' : '';
$inactive_color     = $tab == 'inactive' ? 'erp-nav-tab-active' : '';



?>
<div class="wrap erp-settings">
	<h2><?php _e( 'Modules', 'wp-erp' ); ?></h2>
	<ul class="erp-subsubsub">
		<li><a class="erp-nav-tab <?php echo $all_color; ?>" href="<?php echo $all_url; ?>"><?php printf( __( 'All (%s) |', 'wp-erp' ), $count_all ); ?></a></li>
		<li><a class="erp-nav-tab <?php echo $active_color ; ?>" href="<?php echo $active_url; ?>"><?php printf( __( 'Active (%s) |', 'wp-erp' ), $count_active ); ?></a></li>
		<li><a class="erp-nav-tab <?php echo $inactive_color; ?>" href="<?php echo $inactive_url; ?>"><?php printf( __( 'Inactive (%s)', 'wp-erp' ), $count_inactive  ); ?></a></li>
	</ul>


	<form method="post">
	<table class="widefat fixed plugins" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" id="cb" class="manage-column column-cb check-column">&nbsp;</th>
				<th scope="col" id="name" class="manage-column column-name" style="width: 190px;"><?php _e( 'Title', 'wp-erp' ); ?></th>
				<th scope="col" id="description" class="manage-column column-description"><?php _e( 'Description', 'wp-erp' ); ?></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th scope="col" class="manage-column column-cb check-column">&nbsp;</th>
				<th scope="col" class="manage-column column-name" style="width: 190px;"><?php _e( 'Title', 'wp-erp' ); ?></th>
				<th scope="col" class="manage-column column-description"><?php _e( 'Description', 'wp-erp' ); ?></th>
			</tr>
		</tfoot>

		<tbody id="the-list">

		<?php
			foreach ( $modules as $slug => $module ) {
				$checked = array_key_exists( $slug, $all_active_modules ) ? $slug : '';
				?>
				<tr class="active">
					<th scope="row">
						<input type="checkbox" name="modules[]" id="erp_module_<?php echo $slug; ?>" value="<?php echo $slug; ?>" <?php checked( $slug, $checked ); ?>>
					</th>
					<td class="plugin-title" style="width: 190px;">
						<label for="erp_module_<?php echo $slug; ?>">
							<strong><?php echo isset( $module['title'] ) ? $module['title'] : ''; ?></strong>
						</label>
					</td>
					<td class="column-description desc">
						<div class="plugin-description">
							<p><?php echo isset( $module['description'] ) ? $module['description'] : ''; ?></p>
						</div>
					</td>
				</tr>
				<?php
			}

			if ( ! $modules  ) {
				?>
				<tr class="active">
					<td colspan="3" class="column-description desc">
						<?php _e( 'No modules found!', 'wp-erp' ); ?>
					</td>
				</tr>
				<?php
			}
		?>

		</tbody>
	</table>
	<p class="submit clear">
		<?php wp_nonce_field( 'erp_nonce', 'erp_settings' ); ?>
		<input class="button-primary" type="submit" name="erp_module_status"  value="Save Settings">
	</p>
	</form>

</div>