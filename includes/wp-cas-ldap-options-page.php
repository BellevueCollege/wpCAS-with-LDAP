<?php
/*
 * Copyright (C) 2014 Bellevue College
 * Copyright (C) 2009 Ioannis C. Yessios
 *
 * This file is part of the WordPress CAS Client
 *
 * The WordPress CAS Client is free software; you can redistribute
 * it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Bellevue College
 * Address: 3000 Landerholm Circle SE
 *          Room N215F
 *          Bellevue WA 98007-6484
 * Phone:   +1 425.564.4201
 */

require_once constant( 'CAS_CLIENT_ROOT' ) . '/includes/admin-option-page-functions.php';

/**
 * wp_cas_ldap_options_page function hook for WordPress.
 */
function wp_cas_ldap_options_page( ) {
	global $wp_cas_ldap_options, $form_action;

	// Get Options
	$option_array_def = wp_cas_ldap_get_options( );
?>
	<div class="wrap">
	<h2>CAS Client</h2>
<?php
	echo '<form method="post" action="' . $form_action . '">';
	settings_fields( 'wpcasldap' );
	echo '<h3>';
	_e( 'Configuration settings for WordPress CAS Client', 'wpcasldap' );
	echo '</h3>';

	echo '<h4>';
	_e( 'Note', 'wpcasldap' );
	echo '</h4>';
?>
<p>
<?php
	_e( 'Now that you’ve activated this plugin, WordPress is attempting to authenticate using CAS, even if it’s not configured or misconfigured.', 'wpcasldap' );
	echo '<br />';
	_e( 'Save yourself some trouble, open up another browser or use another machine to test logins. That way you can preserve this session to adjust the configuration or deactivate the plugin.', 'wpcasldap' );
	echo '"';
?>
</p>
<?php
	if ( ! isset( $wp_cas_ldap_options['include_path'] ) ) {
		echo '<h4>';
		_e( 'phpCAS include path', 'wpcasldap' );
		echo '</h4>';
?>
<p>
<?php
		echo '<small><em>';
		_e( 'Note: The phpCAS library is required for this plugin to work. We need to know the server path to the CAS.php file.', 'wpcasldap' );
		echo '</em></small>';
?>
</p>

		<table class="form-table">

	        <tr valign="top">
				<th scope="row">
					<label>
<?php
		_e( 'CAS.php Path', 'wpcasldap' );
?>
					</label>
				</th>

				<td>
<?php
		echo '<input type="text" size="80" name="wpcasldap_include_path" id="include_path_inp" value="' . $option_array_def['include_path'] . '" />';
?>
				</td>
			</tr>

		</table>
<?php
	}

	if ( ! isset( $wp_cas_ldap_options['cas_version'] ) ||
      ! isset( $wp_cas_ldap_options['server_hostname'] ) ||
			! isset( $wp_cas_ldap_options['server_port'] ) ||
			! isset( $wp_cas_ldap_options['server_path'] ) ) {
		echo '<h4>';
		_e( 'phpCAS::client() parameters', 'wpcasldap' );
		echo '</h4>';
?>
	<table class="form-table">
<?php
		if ( ! isset( $wp_cas_ldap_options['cas_version'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
		_e( 'CAS version', 'wpcasldap' );
?>
				</lable>
			</th>

			<td>
				<select name="wpcasldap_cas_version" id="cas_version_inp">
<?php
		echo '<option value="2.0" ';
		echo ( '2.0' === $option_array_def['cas_version'] ) ? 'selected' : '';
		echo '>CAS_VERSION_2_0</option>';
		echo '<option value="1.0" ';
		echo ( '1.0' === $option_array_def['cas_version'] ) ? 'selected' : '';
		echo '>CAS_VERSION_1_0</option>';
?>
				</select>
			</td>
		</tr>
<?php
	}

		if ( ! isset( $wp_cas_ldap_options['server_hostname'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
			_e( 'Server Hostname', 'wpcasldap' );
?>
				</label>
			</th>

			<td>
<?php
			echo '<input type="text" size="50" name="wpcasldap_server_hostname" id="server_hostname_inp" value="' . $option_array_def['server_hostname'] . '" />'
?>
			</td>
		</tr>
<?php
		}

		if ( ! isset( $wp_cas_ldap_options['server_port'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
			_e( 'Server Port', 'wpcasldap' );
?>
				</label>
			</th>

			<td>
<?php
			echo '<input type="text" size="50" name="wpcasldap_server_port" id="server_port_inp" value="' . $option_array_def['server_port'] . '" />';
?>
			</td>
		</tr>
<?php
		}

		if ( ! isset( $wp_cas_ldap_options['server_path'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
			_e( 'Server Path', 'wpcasldap' );
?>
				</label>
			</th>

			<td>
<?php
			echo '<input type="text" size="50" name="wpcasldap_server_path" id="server_path_inp" value="' . $option_array_def['server_path'] . '" />';
?>
			</td>
		</tr>
<?php
		}
?>
	</table>
<?php
	}

	if ( ! isset($wp_cas_ldap_options['useradd'] ) ||
		! isset( $wp_cas_ldap_options['userrole'] ) ||
		! isset( $wp_cas_ldap_options['useldap'] ) ||
		! isset( $wp_cas_ldap_options['email_suffix'] ) ) {

		echo '<h4>';
		_e( 'Treatment of Unregistered User', 'wpcasldap' );
		echo '</h4>';
?>
		<table class="form-table">
<?php
		if ( ! isset( $wp_cas_ldap_options['useradd'] ) ) {
?>
			<tr valign="top">
				<th scope="row">
					<label>
<?php
			_e( 'Add to Database', 'wpcasldap' );
?>
					</lable>
				</th>

				<td>

<?php
			echo '<input type="radio" name="wpcasldap_useradd" id="useradd_yes" value="yes" ';
			echo ( 'yes' === $option_array_def['useradd'] ) ? 'checked="checked"' : '';
			echo ' />';
?>
					<label for="useradd_yes">Yes &nbsp;</label>
<?php
			echo '<input type="radio" name="wpcasldap_useradd" id="useradd_no" value="no" ';
			echo ( 'yes' !== $option_array_def['useradd'] ) ? 'checked="checked"' : '';
			echo ' />';
?>
					<label for="useradd_no">No &nbsp;</label>
				</td>
			</tr>
<?php
		}

		if ( ! isset( $wp_cas_ldap_options['userrole'] ) ) {
?>
			<tr valign="top">
				<th scope="row">
					<label>
<?php
			_e( 'Default Role', 'wpcasldap' );
?>
					</label>
				</th>

				<td>
					<select name="wpcasldap_userrole" id="cas_version_inp">
<?php
						echo '<option value="subscriber" ';
						echo ( 'subscriber' === $option_array_def['userrole'] ) ? 'selected' : '';
						echo '>Subscriber</option>';

						echo '<option value="contributor" ';
						echo ( 'contributor' === $option_array_def['userrole'] ) ? 'selected' : '';
						echo '>Contributor</option>';

						echo '<option value="author" ';
						echo ('author' === $option_array_def['userrole'] ) ? 'selected' : '';
						echo '>Author</option>';

						echo '<option value="editor" ';
						echo ( 'editor' === $option_array_def['userrole'] ) ? 'selected' : '';
						echo '>Editor</option>';

						echo '<option value="administrator" ';
						echo ( 'administrator' === $option_array_def['userrole'] ) ? 'selected' : '';
						echo '>Administrator</option>';
?>
	                </select>
	            </td>
			</tr>
<?php
		}

		if ( ! isset( $wp_cas_ldap_options['useldap'] ) ) {
?>
				<tr valign="top">
					<th scope="row">
						<label>
<?php
			_e( 'Use LDAP to get user info', 'wpcasldap' );
?>
						</label>
					</th>

					<td>
<?php
			echo '<input type="radio" name="wpcasldap_useldap" id="useldap_yes" value="yes" ';
			echo ( 'yes' === $option_array_def['useldap'] ) ? 'checked="checked"' : '';
			echo ' />';
?>
						<label for="useldap_yes">Yes &nbsp;</label>

<?php
			echo '<input type="radio" name="wpcasldap_useldap" id="useldap_no" value="no" ';
			echo ( 'yes' !== $option_array_def['useldap'] ) ? 'checked="checked"' : '';
			echo ' />';
?>
						<label for="useldap_no">No &nbsp;</label>
					</td>
				</tr>
<?php
		} else {
?>
					<input type="hidden" name="wpcasldap_useldap" id="useldap_hidden" value="no" />
<?php
		}
	}

	if ( ! isset( $wp_cas_ldap_options['email_suffix'] ) ) {
?>
		   <tr valign="center">
				<th scope="row">
					<label>
<?php
		_e('E-mail Suffix', 'wpcasldap')
?>
					</label>
				</th>

				<td>
<?php
		echo '<input type="text" size="50" name="wpcasldap_email_suffix" id="server_port_inp" value="';
		echo $option_array_def['email_suffix'];
		echo '" />';
?>
				</td>
			</tr>
<?php
	}
?>
		</table>

<?php

	if ( function_exists( 'ldap_connect' ) ) {
		if ( ! isset( $wp_cas_ldap_options['ldapbasedn'] ) ||
				! isset( $wp_cas_ldap_options['ldapport'] ) ||
				! isset( $wp_cas_ldap_options['ldaphost'] ) ) {
			echo '<h4>';
			_e( 'LDAP parameters', 'wpcasldap' );
			echo '</h4>';
?>

	<table class="form-table">
<?php
			if ( ! isset( $wp_cas_ldap_options['ldaphost'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
				_e( 'LDAP Host', 'wpcasldap' )
?>
				</label>
			</th>

			<td>
<?php
				echo '<input type="text" size="50" name="wpcasldap_ldaphost" id="ldap_host_inp" value="';
				echo $option_array_def['ldaphost'];
				echo '" />';
?>
			</td>
		</tr>
<?php
			}

			if ( ! isset( $wp_cas_ldap_options['ldapport'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
				_e( 'LDAP Port', 'wpcasldap' );
?>
				</label>
			</th>

			<td>
<?php
				echo '<input type="text" size="50" name="wpcasldap_ldapport" id="ldap_port_inp" value="';
				echo $option_array_def['ldapport'];
				echo '"  />';
?>
			</td>
		</tr>
<?php
			}

			if ( ! isset( $wp_cas_ldap_options['ldapbasedn'] ) ) {
?>
		<tr valign="top">
			<th scope="row">
				<label>
<?php
				_e( 'LDAP Base DN', 'wpcasldap' );
?>
				</label>
			</th>
			<td>
<?php
				echo '<input type="text" size="50" name="wpcasldap_ldapbasedn" id="ldap_basedn_inp" value="';
				echo $option_array_def['ldapbasedn'];
				echo '" />';
?>
			</td>
		</tr>
<?php
			}
?>
	</table>
<?php
		}
	}
?>
	<div class="submit">
		<input type="submit" name="wpcasldap_submit" value="Save" />
	</div>
	</form>
<?php
}
